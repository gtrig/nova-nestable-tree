<?php

namespace Gtrig\NestableTree\Services;

class ListService {
    private $resource;
    private $model;
    private $collection;

    public function __construct($resource) {
        $this->resource = $resource;
        $this->loadConfig();
    }

    /**
     * This function gets the list of resources and returns a collection
     * with the children nested inside the parent to be used in the frontend
     *
     * @return void
     */
    public function getCollection() {
        $list = $this->model::where('parent_id', null)
        ->with(['children'])
        ->orderBy('order', 'asc')
        ->get();
        return new $this->collection($list);
    }

    public function updateOrder($list) {
        $resourceList = $this->getResourceList();
        $flattenedList = $this->flattenList($list);
        $updatedCounter = 0;
        foreach ($resourceList as $item) {
            if (isset($flattenedList[$item['id']])) {
                // compare the parent_id and order values and update the database
                if($item->parent_id != $flattenedList[$item['id']]['parent_id'] || $item->order != $flattenedList[$item['id']]['order']) {
                    $item->parent_id = $flattenedList[$item['id']]['parent_id'];
                    $item->order = $flattenedList[$item['id']]['order'];
                    $item->save();
                    $updatedCounter++;
                }
            }
        }
        return $updatedCounter;
    }

    private function loadConfig() {
        $this->model = config('nestable-tree')['sortable_resources'][$this->resource]['model'];
        $this->collection = config('nestable-tree')['sortable_resources'][$this->resource]['collection'];
    }

    /**
     * This function gets the list of resources to compare with the flattened list
     * and update the database accordingly
     *
     * @return array
     */
    private function getResourceList() {
        $model = $this->model;
        $collection = $this->collection;
        $list = $model::all();

        return $list;
    }

    /**
     * This function gets the result list and flattens it into a single array
     * with the parent_id and order values in order to compare and update the database
     *
     * @param [array] $list
     * @param [string] $parent_id
     * @return array
     */
    private function flattenList($list, $parent_id = null) {
        $flattened = [];
        $orderIncrement = 0;
        foreach ($list as $item) {
            $flattened[$item['id']] = [
                'parent_id' => $parent_id,
                'order' => $orderIncrement++
            ];

            if (count($item['elements'])) {
                $flattened = array_merge($flattened, $this->flattenList($item['elements'], $item['id']));
            }
        }

        return $flattened;
    }
}
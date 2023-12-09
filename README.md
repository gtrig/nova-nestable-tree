# Nested Sortable Tool for Laravel Nova

The Nested Sortable tool for Laravel Nova is a powerful tool that allows you to easily sort multiple entities, such as categories, in a nested structure. It provides a configurable solution that requires only two columns in your entities: `parent_id` and `order`.

## Installation

To install the Nested Sortable tool, follow these steps:

1. Install the package using Composer:

    ```shell
    composer require gtrig/nova-nestable-tree
    ```

2. Publish the configuration file:

    ```shell
    php artisan vendor:publish --provider="gtrig\NovaSortableTree\ToolServiceProvider" --tag="config"
    ```

3. Configure your entities:

    - Add the `parent_id` and `order` columns to your entities table.
    - Make sure your entities model extends the `gtrig\NovaSortableTree\SortableTree` class.

4. Register the tool in your `NovaServiceProvider`:

    ```php
    use gtrig\NovaSortableTree\Tool;

    // ...

    public function tools()
    {
         return [
              // ...
              new Tool(),
         ];
    }
    ```

## Usage

To use the Nested Sortable tool, follow these steps:

1. Add the `SortableCategoryResource` to your Nova resource:

    ```php
    use gtrig\NovaSortableTree\SortableCategoryResource;

    // ...

    public function toArray(Request $request): array
    {
         return [
              'id' => $this->id,
              'name' => $this->name,
              'elements' => SortableCategoryResource::collection($this->children),
              'order' => $this->order,
         ];
    }
    ```

2. Configure the tool through the `config/nestable-tree.php` file. You can customize various aspects of the tool, such as the resource class, the column names, and the sorting behavior.

3. Access the Nested Sortable tool in your Laravel Nova admin panel. You will be able to drag and drop entities to rearrange their order and hierarchy.

## Contributinggit

Contributions are welcome! If you encounter any issues or have suggestions for improvements, please open an issue or submit a pull request on the [GitHub repository](https://github.com/gtrig/nova-nestable-tree).

## License

The Nested Sortable tool for Laravel Nova is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
g
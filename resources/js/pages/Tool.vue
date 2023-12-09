<template>
  <div>
    Sorting: {{ resource }}
    <div>
      <button class="btn" @click="loadItems">Reload</button>
      <button class="btn" @click="updateOrder">Save</button>
    </div>
    <DragableList :list="items" />
    <div>
      <button @click="loadItems">Reload</button>
      <button @click="updateOrder">Save</button>
    </div>
  </div>
</template>

<script>
import DragableList from '../components/DragableList.vue';

export default {
  components: {
    DragableList
  },
  props: {
    resource: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      items: [], // Load your items here
      oldItems: []
    };
  },
  created() {
    this.loadItems();
  },
  methods: {
    loadItems() {
      Nova.request().get(`/nova-vendor/nestable-tree/load/${this.resource}`).then(response => {
        this.items = response.data;
        // we need to keep a copy of the original items to compare against
        this.oldItems = response.data;
      });
    },
    updateOrder() {
      Nova.request().post(`/nova-vendor/nestable-tree/update/${this.resource}`, {
        list: this.items
      }).then(response => {
        Nova.success(response.data);
      })
    }
  }
}
</script>
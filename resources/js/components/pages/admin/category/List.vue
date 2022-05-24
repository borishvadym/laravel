<template>
  <div>
    <draggable v-model="categories" @end="onEnd($event, null)">
      <transition-group>
        <div v-for="(category, index) in categories" :key="category.id" class="category-block">
          <category-inline
            :category="category"
            :editRoute="editRoute"
            :deleteRoute="deleteRoute"
            @deleted-row="deleted($event, null)"
          >
          </category-inline>
          <div v-if="category.sub_categories.length > 0" class="sub-categories">
            <draggable v-model="categories[index].sub_categories" @end="onEnd($event, index)">
              <template v-for="sub in category.sub_categories" class="category sub-category">
                <category-inline
                    :category="sub"
                    :editRoute="editRoute"
                    :deleteRoute="deleteRoute"
                    @deleted-row="deleted($event, index)"
                >
                </category-inline>
              </template>
            </draggable>
          </div>
        </div>
      </transition-group>
    </draggable>
  </div>
</template>

<script>
import draggable from 'vuedraggable';

export default {
  name: "CategoriesList",
  components: {
    draggable,
  },
  props: {
    pageData: Array,
    sortingUpdateRoute: String,
    editRoute: String,
    deleteRoute: String,
  },
  data() {
    return {
      categories: this.pageData ? this.pageData : [],
    }
  },
  methods: {
    onEnd (event, index) {
      let data = [];

      if (index !== null) {
        data = this.getSortArray(this.categories[index].sub_categories);
      } else {
        data = this.getSortArray(this.categories);
      }

      axios.post(this.sortingUpdateRoute, {_method: 'patch', order: data});
    },
    getSortArray (categories) {
      let data = [];
      categories.forEach((category, index) => {
        data.push({id: category.id, sort_order: index});
      });
      return data;
    },
    deleted (event, index) {
      let i = null;
      if (index !== null) {
        i = this.categories[index].sub_categories.findIndex(item => item.id === event.row_key);
        this.$delete(this.categories[index].sub_categories, i);
      } else {
        i = this.categories.findIndex(item => item.id === event.row_key);
        this.$delete(this.categories, i);
      }
    },
  }
}
</script>

<style scoped>
.category-block {
  margin: 10px auto;
}
.sub-categories {
  padding-left: 25px;
}
</style>

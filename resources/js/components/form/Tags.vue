<template>
  <div class="form-group">
    <label>Tags</label>
    <input v-model="filter" @focus="focus = true" @blur="focus = false" placeholder="Tag" class="form-control">
    <div v-show="visible" class="tags-select">
      <div v-for="tag in filteredTags" @click="addTag(tag.id)" class="one-select-tag">
        <i class="nav-icon fas fa-plus"></i>
        {{ tag.name }}
      </div>
    </div>
    <div v-if="selectedTags.length > 0" class="selected-tags">
      <div v-for="tag in selectedTags" class="one-selected-tag">
        {{ tag.name }}
        <i class="nav-icon fas fa-times remove-clicker" @click="removeTag(tag.id)"></i>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Tags",
  props: {
    value: Array,
    propsTags: Array,
  },
  data () {
    return {
      filter: '',
      focus: false,
      visible: false,
      selectedTags: this.value ? this.value : [],
      tags: this.propsTags ? this.propsTags : [],
    }
  },
  computed: {
    filteredTags () {
      let tags = [];

      if (!this.filter) {
        tags = this.tags;
      } else {
        tags = this.tags.filter(element => {
          return element.name.includes(this.filter);
        });
      }

      return tags.filter(element => {
        return !this.selectedTags.find(el => el.id === element.id);
      });
    },
  },
  watch: {
    focus (newValue) {
      if (newValue === true) {
        this.visible = true;
      } else {
        setTimeout(() => {
          this.visible = false;
        }, 250);
      }
    },
    selectedTags (newValue) {
      this.$emit('input', newValue);
    }
  },
  methods: {
    addTag (id) {
      this.visible = false;
      this.filter = '';
      let tag = this.tags.find(element => element.id === id);
      this.selectedTags.push(tag);
    },
    removeTag (id) {
      let index = this.selectedTags.findIndex(element => element.id === id);
      this.$delete(this.selectedTags, index);
    }
  },
}
</script>

<style scoped>
.tags-select {
  max-height: 200px;
  overflow-y: scroll;
  background: #dadada;
  padding: 0;
  border-radius: 0 0 5px 5px;
}
.one-select-tag {
  font-size: 14px;
  padding: 10px;
  cursor: pointer;
}
.one-select-tag:hover {
  background: #bbbbbb;
}
.one-select-tag i {
  font-size: 12px;
  margin-right: 10px;
}
.selected-tags {
  overflow: hidden;
  padding: 10px 0;
}
.one-selected-tag {
  float: left;
  padding: 2px 5px;
  border-radius: 10px;
  font-size: 14px;
  background: #48a6ff;
  margin-right: 10px;
  margin-top: 5px;
}
.remove-clicker {
  font-size: 12px;
  cursor: pointer;
}
.remove-clicker:hover {
  color: #fff;
}
</style>

<template>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(tag, index) in tags">
        <td>{{ tag.id }}</td>
        <td>{{ tag.name }}</td>
        <td>{{ tag.slug }}</td>
        <td>
          <button @click="editTag(tag.id)" class="btn btn-sm btn-warning">Edit</button>
          <button class="btn btn-sm btn-danger" @click="deleteTag(tag.id, index)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";

export default {
  name: "TagsList",
  props: {
    propsTags: Array,
    editRoute: String,
    deleteRoute: String,
  },
  data() {
    return {
      tags: this.propsTags ? this.propsTags : [],
    }
  },
  methods: {
    editTag (id) {
      window.location.href = this.editRoute.replace('TAG', id);
    },
    deleteLink (id) {
      return this.deleteRoute.replace('TAG', id);
    },
    deleteTag (id, index) {
      this.$swal.fire({
        title: "Do you really want to delete this tag?",
        text: '',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post(this.deleteLink(id), {_method: 'delete'}).then(result => {
            this.$swal.fire('Deleted', '', 'success');
            this.$delete(this.tags, index);
          }).catch(error => {
            this.$swal.fire('Error', error?.message, 'error');
          });
        }
      });
    },
  }
}
</script>

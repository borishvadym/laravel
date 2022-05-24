<template>
  <div v-if="hasErrors" class="form-input-errors">
    <ul>
      <li v-for="error in errors" class="form-input-error">{{ error }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Errors",
  props: {
    errors: Array
  },
  computed: {
    hasErrors () {
      return this.errors && this.errors.length > 0;
    }
  }
}
</script>

<style scoped>
.form-input-errors {
  background: #ca0000;
  padding: 10px;
  margin: 5px auto;
}
.form-input-errors ul {
  margin: 0;
  padding-left: 10px;
}
.form-input-error {
  color: #fff;
}
</style>

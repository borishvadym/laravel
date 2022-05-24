<template>
  <editor
      :init="initTextarea"
      plugins="lists code wordcount anchor autolink link charmap codesample emoticons fullpage fullscreen hr image imagetools insertdatetime toc table searchreplace visualchars"
      v-model="val"
      @update="onUpdate"
  />
</template>

<script>
import axios from 'axios';
import Editor from '@tinymce/tinymce-vue';

export default {
  name: "Tinymce",
  components: {
    'editor': Editor
  },
  props: {
    uploadImageRoute: String,
    value: String
  },
  computed: {
    uploadImageLink () {
      return this.uploadImageRoute ? this.uploadImageRoute : '/admin/tinymce/image';
    }
  },
  data () {
    return {
      val: this.value ? this.value : '',
      initTextarea: {
        height : "480",
        paste_data_images: true,
        image_advtab: true,
        images_dataimg_filter: function(img) {
          return img.hasAttribute('internal-blob');
        },
        automatic_uploads: true,

        images_upload_handler: (blobInfo, success, failure, folderName) => {
          let formData = new FormData();
          formData.append('file', blobInfo.blob(), blobInfo.filename());

          axios.post(this.uploadImageLink, formData).then(result => {
            success(result.data?.location);
          }).catch(error => {
            failure(error?.message);
            this.$swal.fire('', error?.message, 'error');
          });
        }
      }
    }
  },
  watch: {
    val(newValue) {
      this.$emit('input', newValue);
    },
  },
  methods: {
    onUpdate () {
      this.$emit('update', this.val);
    }
  }
}
</script>

<style scoped>

</style>

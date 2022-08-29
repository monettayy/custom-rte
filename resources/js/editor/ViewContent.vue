<script setup>
import { ref, reactive, onMounted, defineExpose } from 'vue';

let content = ref(null);

const openModal = (parameters=null) => {
  if (parameters){
    content.value = parameters;
  }
  $("#viewContentModal").modal('show');
}

defineExpose({ openModal })
</script>
    
<template>
    <div
        class="modal fade"
        id="viewContentModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Content</h5>
              <button
                class="close"
                type="button"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div v-html="content"></div>
            </div>
          </div>
        </div>
    </div>
</template>
    
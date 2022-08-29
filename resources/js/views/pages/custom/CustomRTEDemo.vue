<script setup>
import { ref } from 'vue';
import RichTextEditor from '../../../editor/RichTextEditor.vue';
import ViewContent from '../../../editor/ViewContent.vue';

const rteComponent = ref(null)
const viewModal = ref(null)

const getText = () => {
    let content = rteComponent.value.getValue();
    viewModal.value.openModal(content);
}
</script>

<template>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Custom Rich Text Editor</h1>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-11 col-sm-12">
            <RichTextEditor ref="rteComponent" @divChange="getTextValue" />
        </div>
        <div class="col-10 text-right mt-2">
            <div class="container">
                <button class="btn btn-primary" @click="getText">View Content</button>
            </div>
        </div>
    </div>
    <ViewContent ref="viewModal" />
</div>
</template>

<style>

</style>
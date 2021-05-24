<template>
    <div class="btn-adapt col-xl-6">
        <create-events-window
            v-show="isVisibleModal"
            @closeWrap="close"
        >
        </create-events-window>

        <div class="button d-flex justify-content-center text-white fw-bold text-uppercase rounded border-2 mb-2"
             @click="showModal()">
            Создать
        </div>
    </div>
</template>

<script>
export default {

    name: "BaseLeftBarButton",

    data() {

        return {
            isVisibleModal: false,
        }
    },

    methods: {

        showModal() {
            this.isVisibleModal = true;
        },

        close() {
            this.isVisibleModal = false;
        },

        saveClickEvent() {
            //console.log('Save event')
            //после удачного сохранения события спрятать форму
            this.isCreateEventWindowVisible = false;
        },
    }
}
</script>

<style scoped>
.button {
    font-family: Roboto;
    background: #1875F0;
    font-weight: 900;
    font-size: 12px;
    line-height: 50px;
    letter-spacing: 1.5px;
    padding: 2px 15px;
    cursor: pointer;
}
@media only screen and (max-width: 1200px) {
    .btn-adapt {
        width: 320px;
    }
}
</style>

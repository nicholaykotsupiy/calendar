<template>
    <div class="col-6">

        <wrap-events
            v-show="isShowWrapEvents"
            @closeWrap="closeWrapEvents"
        >
        </wrap-events>

        <div class="button d-flex justify-content-center text-white fw-bold text-uppercase rounded border-2 ml-5 mb-2"
             @click="showWrapEvents()">
            Создать
        </div>

    </div>
</template>

<script>
export default {

    name: "BaseLeftBarButton",

    data() {

        return {
            isShowWrapEvents: false,
        }
    },

    methods: {

        showWrapEvents() {
            this.isShowWrapEvents = true;
        },

        closeWrapEvents() {
            this.isShowWrapEvents = false;
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
</style>

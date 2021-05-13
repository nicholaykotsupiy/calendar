<template>
    <b-modal id="id-modal" hide-footer title="">
        <p class="mb-4 body-message">Вы подтверждаете удаление мероприятия?</p>
        <div class="row text-center">
            <div class="col-6">
                <button type="button" class="btn btn-primary btn-lg" @click="deleteEvent" data-dismiss="modal">Да</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-outline-secondary btn-lg" data-dismiss="modal"
                        @click="$bvModal.hide('id-modal')" >
                    Нет
                </button>
            </div>
        </div>
    </b-modal>
</template>

<script>
export default {
    name: "DeleteModal",
    methods: {
        deleteEvent() {
            this.$emit('delete')
        }
    }
}
</script>

<style scoped>
    .modal-body .modal-footer {
        border-top: none;
    }
    .body-message {
        text-align: center;
        font-size: 18px;
        margin-top: 0;
    }
    .modal-header {
        border-bottom: none;
    }
</style>

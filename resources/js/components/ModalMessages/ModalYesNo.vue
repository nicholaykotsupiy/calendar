<template>
    <!-- Модальное окно для подтверждения удаления событий-->
    <b-modal id="modal-message-yes-no" hide-footer title="">
        <p class="mb-4 body-message">Вы подтверждаете удаление события?</p>
        <div class="row text-center">
            <div class="col-6">
                <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"
                        @click="deleteMethod"
                >
                    Да
                </button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-outline-secondary btn-lg" data-dismiss="modal"
                        @click="$bvModal.hide('modal-message-yes-no')"
                >
                    Нет
                </button>
            </div>
        </div>
    </b-modal>
</template>

<script>
export default {

    name: "ModalYesNo",

    methods: {

        deleteMethod() {
            //скрыть это окно
            this.$bvModal.hide('modal-message-yes-no')
            //прослушиваем событие deleteMethod в родительском компоненте
            this.$emit('deleteMethod');
        }

    },
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

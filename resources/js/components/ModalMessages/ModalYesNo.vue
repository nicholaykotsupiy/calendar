<template>
    <!-- Модальное окно для подтверждения удаления событий-->
    <b-modal id="modal-message-yes-no" hide-footer title="">
        <p class="mb-4 body-message">Вы подтверждаете удаление мероприятия?</p>
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
import { mapGetters, mapMutations } from 'vuex'

export default {

    name: "ModalYesNo",

    computed: {

        ...mapGetters([
            'valueDeleteIdEvent',
            'valueDeleteTypeEvent',
        ]),
    },

    methods: {

        deleteMethod() {

            //скрыть это окно
            this.$bvModal.hide('modal-message-yes-no')

            //прослушиваем событие deleteMethod в родительском компоненте
            this.$emit('deleteMethod', this.idEvent, this.typeEvent);

            //вот это забрать в метод удаления в родительский компонент:
                //здесь будет происходить определение - какое из видов событий удаляем из БД и стейта и само удаление

                // //сообщение об успешном удалении
                // this.setTitleModalMessage('')
                // this.setBodyModalMessage('Событие удалено!')
                // this.$bvModal.show('modal-message-ok')
                // console.log('Событие удалено!')

                // //сообщение о неуспешном удалении
                // this.setTitleModalMessage('')
                // this.setBodyModalMessage('Событие не удалось удалить!')
                // this.$bvModal.show('modal-message-ok')
                // console.log('Событие не удалось удалить!')
            //

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

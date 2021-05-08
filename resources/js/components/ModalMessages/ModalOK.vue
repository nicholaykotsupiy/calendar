<template>
    <!-- Модальное окно для сообщений об успешном/неуспешном добалении в БД-->
    <b-modal id="modal-message-ok" hide-footer :title="titleModalMessage">
        <p class="mb-4 body-message">{{ bodyModalMessage }}</p>
        <div class="row text-center">
            <div class="col-12">
                <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"
                        @click="$bvModal.hide('modal-message-ok')"
                >
                    ОК
                </button>
            </div>
        </div>
    </b-modal>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

    name: "ModalOK",

    computed: {

        titleModalMessage() {
            return this.titleModalMessage
        },

        bodyModalMessage() {
            return this.bodyModalMessage
        },

        ...mapGetters([
            'titleModalMessage',
            'bodyModalMessage',
        ])
    },

}
</script>

<style>

.modal-header {
    border-bottom: none;
}

.modal-body .modal-footer {
    border-top: none;
}

.body-message {
    text-align: center;
    font-size: 18px;
}

</style>

<template>
    <div class="flex_header">
        <div class="logo"><img :src="logo" alt="logo">
        </div>
        <div class="accoun_flex">
            <div class="user_name">{{ user.name }}</div>
            <div v-if="user.avatar"><img :src="avatar" alt="avatar"></div>
            <div class="dropdown">
                <button class="btn drop dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">
                    <router-link to="/profile" class="dropdown-item drop_links">Мой профиль</router-link>
                    <div class="dropdown-divider"></div>
                    <router-link :to="{name: 'settings.login'}" class="dropdown-item drop_links ">Настройки безопасности</router-link>
                    <div class="dropdown-divider"></div>
                    <router-link to="#" class="dropdown-item drop_links" @click.prevent="logout">Выход из системы</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import logo from '../../../assets/img/logo.png'
import avatar from '../../../assets/img/navigation_user/avatar.png'

export default {
    name: "Header",
    data() {
        return{
            show:false,
            logo,
            avatar
        }
    },
    methods: {
        ...mapActions([
            'saveUserFromServer',
            'saveAccessFromServer',
        ]),
        logout() {
            this.saveUserFromServer(null)
            this.saveAccessFromServer(null)
            this.$router.push({path: '/login'});
        },
    },
    computed: {
        ...mapGetters([
            'access_token',
            'user'
        ]),
    },

}
</script>

<style scoped>
.link .flex{
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    padding-left: 30px;
}
.flex_header{
    display: flex;
    background: #fff;
    justify-content: space-between;
    align-items: center;
    padding:10px 10px 5px 5px;
    margin: 0px;
}

.new_style{
    padding-bottom: 20px;
    padding-right: 20px;
    /*background: url('../images/icons/ic_keyboard_arrow_left.png') no-repeat;*/
    position: relative;
    bottom: 80px;
    left: 95px;
    z-index: 2;
}
.old_style{
    padding-bottom: 20px;
    padding-right: 20px;
    /*background: url('../images/icons/ic_keyboard_arrow_left.png') no-repeat;*/
    transform: rotateY(180deg);
    position: relative;
    bottom: 80px;
    left: 95px;
    z-index: 2;
}
.accoun_flex{
    display: flex;
    justify-content: center;
    align-items: center;
}
.drop_links{
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    color: #808080;
}
.user_name{
    font-family:Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 90px;
    text-align: right;
    padding-right: 20px;
    color: #999999;
}
</style>

<template>
    <div class="col-auto col-sm-8 col-lg-4 profile d-flex justify-content-end align-items-center">
        <div class="name">Анна Кононенко</div>
        <div class="avatar mx-2"><img :src="avatar" alt="avatar"></div>
        <div class="button"><img :src="arrow" alt="arrow"></div>
    </div>
</template>

<script>
import arrow from "../../../assets/img/navigation_user/arrow_down.png";
import avatar from "../../../assets/img/navigation_user/avatar.png";

export default {
    name: "ProfileInfo",
    data: () => ({
        arrow,
        avatar
    }),
}
</script>

<style scoped>
    .profile  {
        font-family: Roboto;
        font-weight: 600;
        font-size: 14px;
        line-height: 90px;
        color: #999;
    }
    .name, .button {
        cursor: pointer;
    }
</style>

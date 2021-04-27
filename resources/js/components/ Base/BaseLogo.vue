<template>
    <div class="col-sm-2 text-center border-end py-4 logo"><img :src="logo" alt="logo"></div>
</template>

<script>
import logo from '../../assets/img/logo.png';
export default {
    name: "BaseLogo",
    data: () => ({
        logo
    })
}
</script>

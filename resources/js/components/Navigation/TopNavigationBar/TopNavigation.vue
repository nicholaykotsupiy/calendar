<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center justify-content-sm-between top-nav">
            <BaseLogo />
            <ProfileInfo />
        </div>
    </div>
</template>

<script>
import BaseLogo from '../../ Base/BaseLogo'
import ProfileInfo from './ProfileInfo'

export default {
    name: "TopNavigation",
    components: {
        BaseLogo,
        ProfileInfo
    }
}
</script>

<style scoped>
    .top-nav {
        background: #FFFFFF;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
    }
</style>

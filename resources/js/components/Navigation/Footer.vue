<template>
    <footer class="footer p-5">
        <div class="container-fluid footer_content">
            <div class="row">
                <div class="col-md-4 policy">
                    <div class=""><img :src="logo" alt="logo"></div>
                    <div class="prave">Все права защищены</div>
                    <div>© OOO «IT 2.0»</div>
                </div>
                <div class="col-md-4 menu">
                    <div class="title_menu">Инструменты</div>
                    <div class="container">
                        <div class="row menu_content">
                            <a href="http://disk.hardsoft.space/recent" class="col-6">Диск</a>
                            <a href="/" class="col-6">Календарь</a>
                            <a href="http://www.ignatenko-project.store/checkPhoto" class="col-6">Фото</a>
                            <a href="http://contacts.hardsoft.space" class="col-6">Контакты</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer_contact">
                    <div class="title_contact">Контакты</div>
                    <div class="container">
                        <div class="row contact_f">
                            <div class="col_link"> <a href="tel:+380959003800">+38 (099) 607-87-26</a></div>
                            <div class="col_link"> <a href="mailto:mail@aiti20.com">mail@aiti20.com</a></div>
                        </div>
                        <div class="background_line"></div>
                        <div class="col-12 col-md-6  text-center text-md-left flex icon_social">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import BaseLogo from "../ Base/BaseLogo";
import logo from '../../assets/img/logo.png';
export default {
    name: "Footer",
    components: {BaseLogo},
    data() {
        return {
            logo
        }
    }
}
</script>

<style lang="scss" scoped>
.contact_f {
    .col_link {
        flex: 1 1 50%;
        min-width: fit-content;
        padding: 0 15px;
    }
}
.footer_content {
   > .row {
       width: 100%;
   }
}

*{
    font-family: Roboto, sans-serif;
    padding: 0;
    margin:0;
}
.footer_content{
    display: flex;
    justify-content: space-around;
    align-items: stretch;
    color: #B3B3B3;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 30px;
}
.policy_photo{
    //background: url("../images/icons/logo_foot2.svg") no-repeat;
    padding-bottom: 80px;
    width: 200px;
}
.prave{
    padding-bottom: 30px;
}
.background_line{
    border-bottom: 2px solid #E6E6E6;
    width: 65px;
}
.menu{
    color: #9B9B9B;
}
.title_menu{
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 30px;
    padding-bottom: 30px;
    color: #666666;
}
.menu_content a{
    color: #666666;
    text-decoration: none;
    padding-bottom: 15px;
}
.title_contact{
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 30px;
    color: #666666;
    padding-bottom: 30px;
}
.slider{
    width: 1050px;
}
.contact_f{
    padding-bottom: 28px;
}
.contact_f a{
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 30px;
    color: #808080;
}
.icon_social{
    padding-top: 32px;
}
.icon_social a{
    padding-right: 19px;
}
.title_hello{
    background: #FFFFFF;
    position: relative;
    z-index: 3;
    box-shadow: 0 0 3px 3px #f1e9e9;
    border-radius: 4px;
    bottom: 80px;
    margin: 0 50px;
    padding-top: 25px;
    padding-bottom: 25px;
}
.contact_item{
    margin-top: 15px;
    margin-bottom: 30px;
}
.font_text{
    font-family: Roboto;
    font-style: normal;
    font-weight: 300;
    font-size: 160px;
    line-height: 240px;
    color: #F5F5F5;
    position: relative;
}
.links{
    background: #f3f0f0;
}

.icon_social a{
    padding-right: 25px;
}
//.facebook{
//    background: url("../images/icons/ic_facebook.png") no-repeat;
//    padding-top: 70px;
//}
//.instagram{
//    background: url("../images/icons/ic_instagram.png") no-repeat;
//    padding-top: 70px;
//}
//.twitter{
//    background: url("../images/icons/ic_twitter.png") no-repeat;
//    padding-top: 70px;
//}
.footer {
    background: #fff;
    z-index: 200;
}
</style>

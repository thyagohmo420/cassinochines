<template>
    <div class="footer md:pb-5 mt-5 footer-color p-4 md:p-8">
        <div class="md:w-11/12 2xl:w-4/6 m-auto py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 ">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div class="footer-list">
                        <ul class="list-none">
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a href="">Cassino</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/casinos')">Eventos</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/casinos')">Missão</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/casinos')">Rebate</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/casinos')">Bônus</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/casinos')">VIP</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/casinos')">Convidar</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/casinos')">Fundo de Previdência</a></li>
                        </ul>
                    </div>
                    <div class="footer-list">
                        <ul class="list-none">
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a href="">Jogos</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/profile/wallet')">Pescaria</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/profile/withdraw')">Slots</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/profile/deposit')">Blockchain</a></li>
                        </ul>
                    </div>
                    <div class="footer-list">
                        <ul class="list-none">
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a href="">Suporte</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/terms/service')">Central de Ajuda</a></li>
                            <li class="  mb-1 transition duration-700 hover:dark:text-white text-white   text-[12px]"><a @click="$router.push('/terms/service')">Bônus de Sugestão</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col">
                    <div class="redes">
                        <img class="redes-imagem" src="/public/assets/images/description/img_facebook.png.png">
                        <img class="redes-imagem" src="/public/assets/images/description/img_tg.png.png">
                        <img class="redes-imagem" src="/public/assets/images/description/img_wa.png.png">
                        <img class="redes-imagem" src="/public/assets/images/description/1779932106484039682.png.png">
                        <img class="redes-imagem" src="/public/assets/images/description/1779932037919752194.png.png">
                        <img class="redes-imagem" src="/public/assets/images/description/1779932191280857089.png.png">
                        <img class="redes-imagem" src="/public/assets/images/description/1779932269934088193.png.png">
                        <img class="redes-imagem" src="/public/assets/images/description/img_line.png.png">
                        <img class="redes-imagem" src="/public/assets/images/description/18plus.png.png">
                    </div>
                    <div v-if="setting">
                        <div>
                            <p class="text-[13px]  mb-1">
                                {{ setting.software_name }}
                            </p>
                        </div>
                        <div>
                            <p class="text-[13px]  mb-1">
                                {{ setting.software_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" teste md:w-11/12 2xl:w-4/6 m-auto  footer-border">
            <div class="md:w-5/6  m-auto footer-imagens">
                <img class="footer-imagem" src="/public/assets/images/footer/1779971422221967361.png.png">
                <img class="footer-imagem" src="/public/assets/images/footer/1779971433311612930.png.png">
                <img class="footer-imagem" src="/public/assets/images/footer/1779971530233589762.png.png">
                <img class="footer-imagem" src="/public/assets/images/footer/1779971546486382594.png.png">
                <img class="footer-imagem" src="/public/assets/images/footer/1779971556100300802.png.png">
                <img class="footer-imagem" src="/public/assets/images/footer/1779972180874366977.png.png">
                <img class="footer-imagem" src="/public/assets/images/footer/1779972487553486850.png.png">
                <img class="footer-imagem" src="/public/assets/images/footer/1782505714194030593.png.png">
                <img class="footer-imagem" src="/public/assets/images/footer/1782505864610160641.png.png">
                <img class="footer-imagem" src="/public/assets/images/footer/1783201630992846849.png.png">
            </div>
        </div>
        <div class="footer-seals">
            <div class="grid gap-2 md:grid-cols-2">
                <p class="text-[14px] text-white col-md-6"><strong>Telefone:</strong> {{ setting.footer_number }}  </p>
                <p class="text-[14px] text-white col-md-6"><strong>E-mail:</strong> {{ setting.footer_email }} </p>
            </div>
        </div>

    </div>

</template>
<script>
    import HttpApi from "@/Services/HttpApi.js";
    import {useSettingStore} from "@/Stores/SettingStore.js";
    import { onMounted, ref } from "vue";
    import { Carousel, Navigation, Slide } from 'vue3-carousel';

    export default {
        props: [],
        components: { Carousel, Navigation, Slide },
        data() {
            return {
                isLoading: false,
                year: new Date().getFullYear(),
                setting: null,
                custom: null,
            }
        },
        setup(props) {
            const ckCarousel = ref(null)

            onMounted(() => {

            });

            return {
                ckCarousel
            };
        },
        computed: {

        },
        mounted() {

        },
        methods: {
            getSetting: function() {
                const _this = this;
                const settingStore = useSettingStore();
                const settingData = settingStore.setting;

                if(settingData) {
                    _this.setting = settingData;
                }
            },
            onCarouselInit(index) {

            },
            onSlideStart(index) {

            },
        },
        created() {
            this.getSetting();
            this.custom = custom;
        },
        watch: {

        },
    };
</script>

<style scoped>
.redes {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    margin-bottom: 16px;
}
.redes-imagem {
    width: 50px;
    height: 50px;
}
.text-white {
   font-weight: 400;
}
.description {
    color: #98A7B5;
}

@media screen and (min-width: 768px) {
    .container-footer {
        display: flex;
        justify-content: space-between;
    }
}
@media screen and (max-width: 768px) {
    .container-footer {
        width: 100%;
        max-width: none;
        flex-direction: column;
        align-items: flex-start;
    }

}
.footer-imagens {
    grid-column-gap: 24px;
    grid-row-gap: 24px;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    padding-top: 32px;
    padding-bottom: 32px;
    display: flex;
}

.footer-border {
    border-top: .5px solid #fdffff1a;
}

@media screen and (max-width: 479px) {
    .footer-imagens {
        grid-column-gap: 16px;
        grid-row-gap: 16px;
    }

}

.footer-imagem {
    max-height: 58px;
    max-width: 150px;
}

@media screen and (max-width: 479px) {
    .footer-imagem  {
        max-height: 35px;
        max-width: 35px;
    }
}

.container-rules {
    max-width: 242rem;
    grid-column-gap: 24px;
    grid-row-gap: 24px;
    justify-content: flex-start;
    align-items: center;
    display: flex;
}

.rule-img {
    max-width: 90px;
    display: block;
}

.providers {
    overflow: hidden;
}

.providers-wrapper {
    grid-column-gap: 22px;
    grid-row-gap: 40px;
    align-items: center;
    display: flex;
}

.gap {
    grid-column-gap: .875rem;
    display: flex;
}

.nav-link {
    width: 100%;
    height: 42px;
    grid-column-gap: 16px;
    grid-row-gap: 16px;
    border: 1px solid #fdffff1a;
    color: rgba(255, 255, 255, .35);
    align-items: center;
    padding-left: 16px;
    padding-right: 16px;
    font-weight: 400;
    display: flex;
    position: relative;
}

.sublink-menu {
    z-index: 2;
    height: 100%;
    grid-column-gap: 16px;
    grid-row-gap: 16px;
    flex: 1;
    align-items: center;
    display: flex;
    position: relative;
    overflow: hidden;
}
.providers-wrapper {
    grid-column-gap: 22px;
    justify-content: center;
    align-items: center;
    display: flex;
}

.item-provider {
    min-height: 88px;
    min-width: 132px;
    background-color: #323637;
    border-radius: .375rem;
    display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.logo {
    padding: 1.75rem;
}

.buttons{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 50px;
    margin-left:10px;
}

.seeAll{
    display: flex;
    align-items: center;
    width:76px;
    height: 16px;
    background: #BBBDBE;
    border-radius: 10px;
    font-size: 9px;
    word-break: keep-all;
    color: black;
    margin-top: 5px;

}

@media screen and (min-width: 621px) {
    logo {
        max-width: 88px;
    }
}

.footer-seals {
    align-items: center;
    -moz-column-gap: 1rem;
    column-gap: 1rem;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 1rem;
    row-gap: .5rem;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    width: 100%;
}

.image {
    height: 1.75rem;
    max-width: 10em;
    width: auto;
}

@media (min-width: 1024px) {
    .image {
        height: 3rem;
    }
}

@media (min-width: 768px) {
    .footer-seals {
        -moz-column-gap: 1.25rem;
        column-gap: 1.25rem;
        padding: 1.5rem;
        row-gap: 1rem;
    }
}

.parent-advisor {
    height: 2.5rem;
    max-width: 10rem;
    width: auto;
    --tw-text-opacity: 1;
    color: #a3d712;
    color: rgb(163 215 18 / var(--tw-text-opacity));
}
</style>

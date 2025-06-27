<template>
    <BaseLayout>
        <LoadingComponent :isLoading="isLoading">
            <div class="text-center">
                <span>{{ $t('Loading data from the platform') }}</span>
            </div>
        </LoadingComponent>

        <div v-if="!isLoading" class="bg-img">
            <!-- Banners carousel -->
            <div class="carousel-banners bg-img">
                <div class="md:w-11/12 2xl:w-4/6 sm:w-full mx-auto md:px-0">
                    <div class="">
                        <Carousel v-bind="settings" :breakpoints="breakpoints" ref="carouselBanner">
                            <Slide v-for="(banner, index) in banners" :key="index">
                                <div class="carousel__item rounded w-full">
                                    <a :href="banner.link" class="w-full h-full bg-blue-800 rounded">
                                        <img style="border-radius: 20px;"
                                            :src="`/storage/` + banner.image" alt="" class=" h-full mt-2 md:mt-4 w-full rounded">
                                    </a>
                                </div>
                            </Slide>

                            <template #addons>
                                <navigation>
                                    <template #next>
                                        <i class="fa-solid fa-chevron-right text-white"></i>
                                    </template>
                                    <template #prev>
                                        <i class="fa-solid fa-chevron-left text-white"></i>
                                    </template>
                                </navigation>
                                <Pagination />
                            </template>
                        </Carousel>
                        <br>

                    </div>
                </div>
            </div>

            <div class="background-sound md:w-11/12 2xl:w-4/6  mx-auto mb-4 md:px-0">
                <img  class="sound" src="/public/assets/images/volume 1.svg"/>
                <div class="slide-container">
                    <p class="sound-text">Convide um membro para ganhar uma recompensa de R$ 10 ou mais.</p>
                </div>
            </div>

            <JackpotCounter/> 

            <div class="md:w-11/12 2xl:w-4/6  mx-auto px-4 md:px-0">
                <!-- categories -->
                <div v-if="categories" class="category-list">
                    <div class="flex mb-5 gap-4"
                        style="min-height: 78px; max-height: 200px; overflow-x: auto; overflow-y: hidden;">
                        <div class="border-list flex flex-row items-center w-full items-baseline"
                            style="min-width: 100%; white-space: nowrap;">
                                <RouterLink :to="{ name: 'casinosAll', params: { provider: 'all' } }"
                                    class="active flex flex-col justify-center items-center min-w-[80px] text-center">
                                    <div class="">
                                        <img  src="/public/assets/images/categorias/fire.png" alt="" width="42" class="">
                                    </div>
                                    <p class="text-category mt-3">Popular</p>
                                </RouterLink>
                                <RouterLink :to="{ name: 'casinosAll', params: { provider: 'all' } }"
                                    class="flex flex-col justify-center items-center min-w-[80px] text-center">
                                    <div class="">
                                        <img  src="/public/assets/images/categorias/slots.svg" alt="" width="42" class=" category-img-color">
                                    </div>
                                    <p class="text-category mt-3">Popular</p>
                                </RouterLink>
                                <RouterLink :to="{ name: 'casinosAll', params: { provider: 'all' } }"
                                    class="flex flex-col justify-center items-center min-w-[80px] text-center">
                                    <div class="">
                                        <img  src="/public/assets/images/categorias/game.svg" alt="" width="42" class=" category-img-color">
                                    </div>
                                    <p class="text-category mt-3">Games</p>
                                </RouterLink>
                                <RouterLink :to="{ name: 'casinosAll', params: { provider: 'all' } }"
                                    class="flex flex-col justify-center items-center min-w-[80px] text-center">
                                    <div class="">
                                        <img  src="/public/assets/images/categorias/shark.svg" alt="" width="42" class=" category-img-color">
                                    </div>
                                    <p class="text-category mt-3">Pescaria</p>
                                </RouterLink>
                                <RouterLink :to="{ name: 'casinosAll', params: { provider: 'all' } }"
                                    class="flex flex-col justify-center items-center min-w-[80px] text-center">
                                    <div class="">
                                        <img  src="/public/assets/images/categorias/recent.svg" alt="" width="42" class=" category-img-color">
                                    </div>
                                    <p class="text-category mt-3">Recente</p>
                                </RouterLink>
                        </div>
                    </div>
                </div>


                <div v-if="featured_games">
                    <div class="w-full flex justify-between mb-4">
                        <div class="flex">
                            <img src="/public/assets/images/SVG(12) (4).svg">
                            <h2 class="text-xl font-500">Popular</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 md:grid-cols-6 gap-4 mb-5">
                        <CassinoGameCard v-for="(game, index) in featured_games" :index="index" :title="game.game_name"
                            :cover="game.cover" :gamecode="game.game_code" :type="game.distribution" :game="game" />
                    </div>
                </div>

                <div class="mt-10">
                    <Carousel v-bind="settingsRecommended" :breakpoints="breakpointsRecommended"
                        ref="carouselSubBanner">
                        <Slide v-for="(banner, index) in bannersHome" :key="index">
                            <div class="carousel__item  min-h-[60px] md:min-h-[150px] rounded-2xl w-full mr-4">
                                <a :href="banner.link" class="w-full h-full rounded-2xl">
                                    <img :src="`/storage/` + banner.image" alt="" class=" h-full w-full rounded-2xl">
                                </a>
                            </div>
                        </Slide>
                    </Carousel>
                </div>

                <div class="mt-5">
                    <ShowProviders v-for="(provider, index) in providers" :provider="provider" :index="index" />
                </div>


            </div>
        </div>
    </BaseLayout>
</template>

<script>
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import { onMounted, ref } from "vue";
import JackpotCounter from "@/Components/UI/JackpotCounter.vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import MakeDeposit from "@/Components/UI/MakeDeposit.vue";
import { RouterLink, useRoute } from "vue-router";
import { useAuthStore } from "@/Stores/Auth.js";
import LanguageSelector from "@/Components/UI/LanguageSelector.vue";
import CassinoGameCard from "@/Pages/Cassino/Components/CassinoGameCard.vue";
import HttpApi from "@/Services/HttpApi.js";
import ShowCarousel from "@/Pages/Home/Components/ShowCarousel.vue";
import { useSettingStore } from "@/Stores/SettingStore.js";
import LoadingComponent from "@/Components/UI/LoadingComponent.vue";
import ShowProviders from "@/Pages/Home/Components/ShowProviders.vue";
import { searchGameStore } from "@/Stores/SearchGameStore.js";
import CustomPagination from "@/Components/UI/CustomPagination.vue";
import LastWinnersComponent from "@/Components/UI/LastWinnersComponent.vue";


export default {
    props: [],
    components: {
        CustomPagination,
        Pagination,
        ShowProviders,
        LoadingComponent,
        ShowCarousel,
        JackpotCounter,
        CassinoGameCard,
        Carousel,
        Navigation,
        Slide,
        LanguageSelector,
        MakeDeposit,
        BaseLayout,
        RouterLink,
        LastWinnersComponent
    },
    data() {
        return {
            isLoading: true,

            // categories: [
            //     {
            //         name: 'Dragon',
            //         image: '/assets/images/categories/dragon.svg'
            //     },
            //     {
            //         name: 'Betting',
            //         slug: 'Live',
            //         image: '/assets/images/categories/betting.svg'
            //     },
            //     {
            //         name: 'Casino',
            //         image: '/assets/images/categories/casino.svg'
            //     },
            //     {
            //         name: 'Casino',
            //         slug: 'Live',
            //         image: '/assets/images/categories/casino-live.svg'
            //     },
            //     {
            //         name: 'E-sports',
            //         image: '/assets/images/categories/esports.svg'
            //     },
            //     {
            //         name: 'Mines',
            //         image: '/assets/images/categories/mines.svg'
            //     },
            //     {
            //         name: 'Fortune',
            //         slug: 'Tiger',
            //         image: '/assets/images/categories/fortune-tiger.svg'
            //     },
            //     {
            //         name: 'Aviator',
            //         image: '/assets/images/categories/aviator.svg'
            //     },
            //     {
            //         name: 'Spaceman',
            //         image: '/assets/images/categories/spaceman.svg'
            //     },
            //     {
            //         name: 'Blackjack',
            //         slug: 'Live',
            //         image: '/assets/images/categories/blackjack-live.svg'
            //     },
            //     {
            //         name: 'Roulette',
            //         slug: 'Live',
            //         image: '/assets/images/categories/roulette-live.svg'
            //     },
            //     {
            //         name: 'Football',
            //         slug: 'Studio',
            //         image: '/assets/images/categories/football-studio.svg'
            //     },
            // ],

            /// banners settings
            settings: {
                itemsToShow: 1,
                snapAlign: 'center',
                autoplay: 6000,
                wrapAround: true
            },
            breakpoints: {
                700: {
                    itemsToShow: 1,
                    snapAlign: 'center',
                },
                1024: {
                    itemsToShow: 1,
                    snapAlign: 'center',
                },
            },

            settingsRecommended: {
                itemsToShow: 2,
                snapAlign: 'start',
            },
            breakpointsRecommended: {
                700: {
                    itemsToShow: 3,
                    snapAlign: 'center',
                },
                1024: {
                    itemsToShow: 3,
                    snapAlign: 'start',
                },
            },

            /// banners
            banners: null,
            bannersHome: null,

            settingsGames: {
                itemsToShow: 2.5,
                snapAlign: 'start',
            },
            breakpointsGames: {
                700: {
                    itemsToShow: 3.5,
                    snapAlign: 'center',
                },
                1024: {
                    itemsToShow: 6,
                    snapAlign: 'start',
                },
            },
            providers: null,

            featured_games: null,
            categories: null,
        }
    },
    setup(props) {
        const ckCarouselOriginals = ref(null)

        onMounted(() => {

        });

        return {
            ckCarouselOriginals
        };
    },
    computed: {
        searchGameStore() {
            return searchGameStore();
        },
        userData() {
            const authStore = useAuthStore();
            return authStore.user;
        },
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
        setting() {
            const settingStore = useSettingStore();
            return settingStore.setting;
        }
    },
    mounted() {

    },
    methods: {
        getCasinoCategories: async function() {
            const _this = this;
            await HttpApi.get('categories')
                .then(response => {
                    _this.categories = response.data.categories;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {

                    });
                });
        },
        toggleSearch: function () {
            this.searchGameStore.setSearchGameToogle();
        },
        getBanners: async function () {
            const _this = this;

            try {
                const response = await HttpApi.get('settings/banners');
                const allBanners = response.data.banners;

                _this.banners = allBanners.filter(banner => banner.type === 'carousel');
                _this.bannersHome = allBanners.filter(banner => banner.type === 'home');
            } catch (error) {
                console.error(error);
            } finally {

            }
        },
        getAllGames: async function () {
            const _this = this;
            return await HttpApi.get('games/all')
                .then(async response => {
                    if (response.data !== undefined) {
                        _this.providers = response.data.providers;
                        _this.isLoading = false;
                    }
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        console.log(`${value}`);
                    });
                    _this.isLoading = false;
                });
        },
        getFeaturedGames: async function () {
            const _this = this;
            return await HttpApi.get('featured/games')
                .then(async response => {


                    _this.featured_games = response.data.featured_games;
                    _this.isLoading = false;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        console.log(`${value}`);
                    });
                    _this.isLoading = false;
                });
        },
        initializeMethods: async function () {
            await this.getCasinoCategories();
            await this.getBanners();
            await this.getAllGames();
            await this.getFeaturedGames();
        }

    },
    async created() {
        await this.initializeMethods();
    },
    watch: {


    },
};
</script>


<style scoped>
.bg-img{
    background-image: url("/public/assets/images/Modo_de_isolamento.svg"); /* adjust the value to desired opacity (0-1) */
    height: 100%;
}
h2 {
    color: #FFFFFF;
}
.sound-text {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    animation: slide 20s infinite linear;
    color: #FFFFFF;
    white-space: nowrap;
}
.slide-container {
    width: 100%;
    overflow: hidden;
    position: relative;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding-right: 10px;
}
@keyframes slide {
  0% {
    transform: translate(70%);
  }
  to {
    transform: translate(-110%);
  }
}

.background-sound {
    background: var(--input-primary-dark);
    display: flex;
    gap: 20px;
    padding: 8px;
    border-radius: 8px;
}
.text-category {
    color: #FFFFFF;
    font-size: 16px;
    font-weight: 400;
}
.border-list {
    border-bottom: 1px solid var(--ci-secundary-color);
    padding-bottom: 8px;
}

.active::after {
    content: "";
    width: 99px;
    height: 3px;
    top: 8px;
    position: relative;
    border-radius: 4px 4px 0px 0px;
    --tw-bg-opacity: 1;
    background-color: var(--ci-secundary-color);
}
.category-title {
    color: #FDFFFF;
}
.searchbarButton{
    position: absolute;
    top:13px;
    right:-25px;
    z-index: 2;
}

.searchbar {
    border-radius: 4px;
    background: var(--input-primary-dark);
    padding-left: 35px;

}

.searchbar::placeholder{
    padding: 10px;
    padding-left: 10px;
    font-size: 12px;
}

.category-subtitle {
    color: #FDFFFF;
    font-size: 10px;
    font-weight: 500;
}

.category-img {
    background-color: var(--ci-category-color);
}

</style>

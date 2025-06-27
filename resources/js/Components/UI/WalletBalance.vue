<template>
    <button style="background-color: inherit; border: none;" @click="$router.push('/profile/wallet')" type="button"
        class="flex justify-center items-center mr-[40px]  pt-1 wallet-money">
        <img class=" absolute w-[175px] h-[32px]" src="/public/assets/images/Group 1000001706.svg">
        <div class=" mr-1 ml-1 relative">
            <strong style="font-size: 13px; text-decoration: underline; color: #FFAA09;">{{ (displayNumber - Math.trunc(displayNumber)).toFixed(2) === "0.00" ? displayNumber>1000 ? displayNumber/1000 + "k" : displayNumber + ".00": displayNumber > 1000 ? displayNumber/1000 + "k" : displayNumber  }}</strong>
        </div>
        <!--        <div class="ml-2 text-sm">-->
        <!--            <i class="fa-solid fa-chevron-down"></i>-->
        <!--        </div>-->
    </button>
</template>

<script>
import HttpApi from "@/Services/HttpApi.js";
import { onMounted, ref, watch, watchEffect, reactive } from "vue";
import { useRoute } from "vue-router";
import gsap from 'gsap'


export default {
    props: [],
    components: {},
    data() {
        return {
            isLoadingWallet: false,
            wallet: null,
            processInterval: null,
            balance: 0,
            displayNumber: 0
        }
    },
    setup(props) {
        const route = useRoute();
        const isCasinoPlayPage = ref(false);

        watchEffect(() => {
            checkRoute();
        });

        onMounted(() => {
            checkRoute();
        });

        function checkRoute() {
            // Verifique se a rota atual é 'casinoPlayPage'
            isCasinoPlayPage.value = route.name === 'casinoPlayPage';
        }

        return {
            isCasinoPlayPage
        };
    },
    computed: {

    },
    beforeUnmount() {
        clearInterval(this.processInterval);
    },
    mounted() {

    },
    methods: {
        getWallet: async function () {
            const _this = this;
            await HttpApi.get('profile/wallet')
                .then(response => {
                    _this.wallet = response.data.wallet;
                    _this.isLoadingWallet = false;
                    _this.balance = _this.wallet?.total_balance;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        if (value == 'unauthenticated') {
                            localStorage.clear();
                            clearInterval(this.processInterval);
                        }
                    });

                    _this.isLoadingWallet = false;
                });
        },

        animationCountUp() {
            clearInterval(this.interval);

            if (this.displayNumber >= this.balance) {
                this.displayNumber = this.balance;
                return;
            }
            this.interval = window.setInterval(() => {
                const  decimalPart = (this.balance - Math.trunc(this.balance)).toFixed(2);
                if (this.displayNumber != this.balance) {
                    var change = (this.balance - this.displayNumber) / 10;
                    change = change >= 0 ? Math.ceil(change) : Math.floor(change);
                    if (this.displayNumber + change <= this.balance) {
                        this.displayNumber = this.displayNumber + change;
                    }else{
                           this.displayNumber = Number(this.displayNumber) + Number(decimalPart)
                           clearInterval(this.interval);
                    }
                }
            }, 30);
        }
    },
    async created() {

        if (this.isCasinoPlayPage) {
            this.processInterval = setInterval(async () => {
                await this.getWallet(); // Substitua 'seuMetodo' pelo nome do seu método
            }, 1000);
        }

        await this.getWallet(); // Substitua 'seuMetodo' pelo nome do seu método
        this.animationCountUp();
    },
    watch: {
    }
};
</script>

<style scoped></style>

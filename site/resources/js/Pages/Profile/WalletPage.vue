<template>
    <BaseLayout>
        <div v-if="setting != null" class="md:w-11/12 2xl:w-4/6 mx-auto px-4 md:px-0 mt-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="col-span-1 hidden md:block">
                    <WalletSideMenu />
                </div>
                <div class="relative col-span-2">
                    <div v-if="!isLoadingWallet" class="flex flex-col w-full p-4 rounded ">
                        <div class="p-9 grid grid-cols-1 md:grid-cols-2 gap-4 w-full background">
                            <div class="flex w-full">
                                <img class="money" src="/public/assets/images/money.svg">
                                <div class="leading-4 ml-3">
                                    <span class="span-text">Saldo Total</span>
                                    <h1 class="text-lg font-bold green-money">{{ state.currencyFormat(parseFloat(wallet.balance), wallet.currency) }}</h1>
                                </div>
                            </div>
                            <div class="flex w-full">
                               <img class="money" src="/public/assets/images/money.svg">
                                <div class="leading-4 ml-3">
                                    <span class="span-text">Saldo de Bônus</span>
                                    <h1 class="text-lg font-bold green-money">{{ state.currencyFormat(parseFloat(wallet.balance_bonus), wallet.currency) }}</h1>
                                </div>
                            </div>
                            <div class="flex w-full">
                               <img class="money" src="/public/assets/images/money.svg">
                                <div class="leading-4 ml-3">
                                    <span class="span-text">{{ $t('Withdrawal Balance') }}</span>
                                    <h1 class="text-lg font-bold green-money">{{ state.currencyFormat(parseFloat(wallet.balance_withdrawal), wallet.currency) }}</h1>
                                </div>
                            </div>
                            <div v-if="setting.disable_rollover === false || setting.rollover_deposit > 0" class="flex justify-between w-full col-span-2">
                                <div class="flex w-1/2">
                                    <img class="money" src="/public/assets/images/money.svg">
                                    <div class="leading-4 ml-3">
                                        <span class="span-text">Rollover de Deposito</span>
                                        <h1 class="text-lg font-bold green-money">{{ state.currencyFormat(parseFloat(wallet.balance_deposit_rollover), wallet.currency) }}</h1>
                                    </div>
                                </div>
                                <div class="w-1/2">
                                    <div class="w-full bg-gray-200 rounded-full">
                                        <div class="bg-green-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full truncate px-3" :style="{ width: rolloverPercentage(parseFloat(wallet.balance_deposit_rollover))   }">
                                            {{ rolloverPercentage(parseFloat(wallet.balance_deposit_rollover)) }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="setting.disable_rollover === false || setting.rollover > 0" class="pl-9 py-5 flex justify-between w-full col-span-2">
                           <div class="flex w-1/2">
                               <img class="money" src="/public/assets/images/money.svg">
                               <div class="leading-4 ml-3">
                                   <span class="bold-text">Rollover de Bônus</span>
                                   <h1 class="text-lg font-bold green-money">{{ state.currencyFormat(parseFloat(wallet.balance_bonus_rollover), wallet.currency) }}</h1>
                               </div>
                           </div>
                            <div class="w-1/2">
                                <div class="w-full bg-gray-600 rounded-full mb-1">
                                    <div class="flex bg-green-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full truncate px-3" :style="{ width: rolloverPercentage(parseFloat(wallet.balance_bonus_rollover))   }">
                                        {{ rolloverPercentage(parseFloat(wallet.balance_bonus_rollover)) }}% - Barra de Rollover
                                    </div>
                                </div>
                                <div class="w-full bg-gray-600 rounded-full">
                                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full truncate px-3" :style="{ width: rolloverPercentage(parseFloat(setting.rollover_protection))   }">
                                        {{ rolloverPercentage(parseFloat(setting.rollover_protection)) }} - Barra de Proteção
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                            <a @click.prevent="$router.push('/profile/deposit')" href="" class="flex background-wallet p-4 border border-gray-300  rounded-lg">
                                <img class="wallet" src="/public/assets/images/icons/wallet-money.svg">
                                <div class="flex flex-col">
                                    <h1 class="text-lg bold-text">{{ $t('Deposit') }}</h1>
                                    <p class="text-sm dark:text-gray-500 ligth-text">{{ $t('Click here to deposit') }}</p>
                                </div>
                            </a>
                            <a @click.prevent="$router.push('/profile/withdraw')" href="" class="flex background-wallet p-4 border border-gray-300  rounded-lg">
                                <img class="wallet" src="/public/assets/images/icons/withdraw.svg">
                                <div class="flex flex-col">
                                    <h1 class="text-lg bold-text">{{ $t('Withdraw') }}</h1>
                                    <p class="text-sm dark:text-gray-500 ligth-text">{{ $t('Click here to withdraw') }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="mt-5 flex flex-col">
                            <h1 class="mb-3 text-2xl bold-text">{{ $t('My Wallets') }}</h1>
                            <div class="w-48 border border-gray-200 rounded-lg background dark:text-white w-full">
                                <button v-for="(wallet, index) in mywallets" :key="index" @click.prevent="setWallet(wallet.id)" type="button" class="relative inline-flex justify-between items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                   <div class="flex items-center">
                                        <img class="wallet" src="/public/assets/images/money.svg">
                                       <div class="flex flex-col items-start">
                                           <p>{{ wallet.symbol }} {{ wallet.total_balance }}</p>
                                           <p class="text-[12px] dark:text-gray-500">{{ wallet.symbol }} {{ wallet.balance_bonus }}</p>
                                       </div>
                                   </div>

                                    <span v-if="wallet.active === 1" class="bg-green-100 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Ativo</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-if="isLoadingWallet" role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                        <span class="sr-only">{{ $t('Loading') }}...</span>
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>


<script>

import { RouterLink } from "vue-router";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import WalletSideMenu from "@/Pages/Profile/Components/WalletSideMenu.vue";
import {useToast} from "vue-toastification";
import {useAuthStore} from "@/Stores/Auth.js";
import HttpApi from "@/Services/HttpApi.js";
import {useSettingStore} from "@/Stores/SettingStore.js";

export default {
    props: [],
    components: {WalletSideMenu, BaseLayout, RouterLink },
    data() {
        return {
            isLoading: false,
            isLoadingWallet: true,
            wallet: null,
            mywallets: null,
            setting: null,
        }
    },
    setup(props) {


        return {};
    },
    computed: {

    },
    mounted() {

    },
    methods: {
        setWallet: function(id) {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingWallet = true;

            HttpApi.post('profile/mywallet/'+ id, {})
                .then(response => {
                   _this.getMyWallet();
                    _this.isLoadingWallet = false;
                    window.location.reload();

                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoadingWallet = false;
                });
        },
        getWallet: function() {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingWallet = true;

            HttpApi.get('profile/wallet')
                .then(response => {
                    _this.wallet = response.data.wallet;
                    _this.isLoadingWallet = false;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoadingWallet = false;
                });
        },
        getMyWallet: function() {
            const _this = this;
            const _toast = useToast();

            HttpApi.get('profile/mywallet')
                .then(response => {
                    _this.mywallets = response.data.wallets;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                });
        },
        getSetting: function() {
            const _this = this;
            const settingStore = useSettingStore();
            const settingData = settingStore.setting;

            if(settingData) {
                _this.setting = settingData;
            }

            _this.isLoading = false;
        },
        rolloverPercentage(balance) {
            return Math.max(0, ((balance / 100) * 100).toFixed(2));
        },
    },
    created() {
        this.getWallet();
        this.getMyWallet();
        this.getSetting();
    },
    watch: {

    },
};
</script>

<style scoped>
.background {
    border: 1px solid #FFFF;
    border-radius: 12px;
}

.money {
    width: 41px;
    height: 41px;
    filter: brightness(0) invert(1);
}

.green-money {
    color: #00C838;
    font-weight: 700;
}

.span-text {
    font-weight: 500;
    color: #FDFFFF;
}

.bold-text {
    font-weight: 700;
    color: #FDFFFF;
}

.ligth-text {
    font-weight: 400;
}

.background-wallet {
    border: 1px solid #FFFF;
    border-radius: 12px;
}
.wallet {
    width: 41px;
    height: 41px;
    margin-right: 22px;
    margin-left: 1.25rem;
    filter: brightness(0) invert(1);
}

.bg-green-100  {
    background-color: #008515;
}
</style>

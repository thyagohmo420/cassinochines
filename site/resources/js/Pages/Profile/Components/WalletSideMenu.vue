<template>
    <h1 class="text-2xl font-bold mb-3">{{ $t('Wallet') }}</h1>
    <div class="w-full rounded shadow">
        <ul>
            <li class="w-full mb-3">
                <RouterLink :to="{ name: 'profileWallet' }"
                            active-class="wallet-active"
                            class="flex w-full background px-4 py-3 rounded hover:dark:bg-gray-900 transition duration-700">
                    <span class="w-8"> <img class="money" src="/public/assets/images/icons/wallet-money.svg"></span>
                    <span>{{ $t('Balance') }}</span>
                </RouterLink>
            </li>

            <li class="w-full mb-3">
                <RouterLink :to="{ name: 'profileDeposit' }"
                            active-class="wallet-active"
                            class="flex w-full background px-4 py-3 rounded hover:dark:bg-gray-900 transition duration-700">
                    <span class="w-8"><img class="money" src="/public/assets/images/icons/wallet-money.svg"></span>
                    <span>{{ $t('Deposit') }}</span>
                </RouterLink>
            </li>

            <li class="w-full mb-3">
                <RouterLink :to="{ name: 'profileWithdraw' }"
                            active-class="wallet-active"
                            class="flex w-full background px-4 py-3 rounded hover:dark:bg-gray-900 transition duration-700">
                    <span class="w-8"><img class="money" src="/public/assets/images/icons/withdraw.svg"></span>
                    <span>{{ $t('Withdraw') }}</span>
                </RouterLink>
            </li>

            <li class="w-full ">
                <RouterLink :to="{ name: 'profileTransactions' }"
                            active-class="wallet-active"
                            class="flex w-full background px-4 py-3 rounded hover:dark:bg-gray-900 transition duration-700">
                    <span class="w-8"><i class="fa-sharp fa-regular fa-bars text-xl" style="color: #fff"></i></span>
                    <span>{{ $t('Transactions') }}</span>
                </RouterLink>
            </li>
        </ul>

    </div>
</template>

<script>

export default {
    props: [],
    components: {},
    data() {
        return {
            isLoading: false,
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

    },
    watch: {

    },
};
</script>

<style scoped>
.background {
    border: 1px solid #FFFF;
    border-radius: 11px;
}

.money {
    width: 18px;
    height: 18px;
    filter: brightness(0) invert(1);
}

.w-8 {
    display: flex;
    align-items: center;
}
</style>

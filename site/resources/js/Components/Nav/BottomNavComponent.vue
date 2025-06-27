<template>
    <div class="flex sm:hidden">
        <div  class="fixed z-40 w-full h-16 max-w-lg -translate-x-1/2 navtop-color border border-gray-200 bottom-0 left-1/2 dark:bg-gray-800 dark:border-gray-800">
            <div class="flex items-center justify-between h-full max-w-lg  mx-auto">
                <button @click="$router.push('/casinos')" data-tooltip-target="tooltip-casino" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <img class="mb-2  mt-1" src="/public/assets/images/chamine-de-casa 1.svg" width="20" height="20" alt="">
                    <span class="text-[12px] text-white">Inicio</span>
                </button>
                <button @click="$router.push('/profile/deposit')" data-tooltip-target="tooltip-casino" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <img  class="mb-2 mt-1 " src="/public/assets/images/circulo-usd 1.svg" width="20" height="20" alt="">
                    <span class="text-[12px] text-white">{{ $t('Deposit') }}</span>
                </button>
                <button @click="$router.push('/profile/affiliate')" data-tooltip-target="tooltip-sport" type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-r-full hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <img class="mb-2  mt-1" src="/public/assets/images/do-utilizador (1) 1.svg" width="20" height="20" alt="">
                    <span class="text-[12px] text-white">Convidar</span>
                </button>
                <div id="tooltip-sport" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Convidar
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <button @click="$router.push('/profile/wallet')" data-tooltip-target="tooltip-wallet" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <img class="mb-2  mt-1" src="/public/assets/images/carteira (2) 1.svg" width="20" height="20" alt="">
                    <span class="text-[12px] text-white">{{ $t('Wallet') }}</span>
                </button>
                <div id="tooltip-wallet" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    {{ $t('Wallet') }}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
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

    mounted() {

    },
    methods: {
      
    },
    watch: {

    },
};
</script>

<style scoped>

</style>

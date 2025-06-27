<template>
    <button style="border-radius: 9px; background-color: var(--button-text);" @click.prevent="toggleModalDeposit" type="button" :class="[showMobile === false ? 'hidden md:flex' : '', isFull ? 'w-full' : '']" class="border-[none] w-[114px] h-[32px] items-center mr-3 ml-2  justify-center  rounded">
       <h6 style="font-weight: 400; color: black;" class="">{{ title }}</h6> 
        <img src="/public/assets/images/Polygon 1.svg"  class="ml-2">
    </button>

    <div id="modalElDeposit" tabindex="-1" aria-hidden="true" class="fixed  top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-screen md:h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full dark:bg-[#17181b] ">
            <div class="flex flex-col md:justify-between px-6 pb-8 my-auto">
                <div class="flex justify-between modal-header mb-6 mt-6">
                    <div>
                        <h1 class="font-bold text-xl">{{ $t('Deposit') }}</h1>
                        <p><small>{{ $t('Choose your payment method')}}</small></p>
                    </div>
                </div>

                <DepositWidget />
            </div>
        </div>
    </div>
</template>

<script>
    import {useAuthStore} from "@/Stores/Auth.js";
    import DepositWidget from "@/Components/Widgets/DepositWidget.vue";
    import {onMounted} from "vue";
    import {initFlowbite} from "flowbite";

    export default {
        props: ['showMobile', 'title', 'isFull'],
        components: { DepositWidget },
        data() {
            return {
                isLoading: false,
                modalDeposit: null,
            }
        },
        setup(props) {
            onMounted(() => {
                initFlowbite();
            });

            return {};
        },
        computed: {
            isAuthenticated() {
                const authStore = useAuthStore();
                return authStore.isAuth;
            },
        },
        mounted() {
            this.modalDeposit = new Modal(document.getElementById('modalElDeposit'), {
                placement: 'center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: true,
                onHide: () => {
                    this.paymentType = null;
                },
                onShow: () => {

                },
                onToggle: () => {

                },
            });
        },
        beforeUnmount() {

        },
        methods: {
            toggleModalDeposit: function() {
                this.modalDeposit.toggle();
            },
        },
        created() {

        },
        watch: {

        },
    };
</script>

<style scoped>

</style>

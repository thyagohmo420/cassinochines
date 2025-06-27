<template>
    <div class="float mb-[120px]">
        <a href="https://web.telegram.org/k/ ">
            <img  src="/public/assets/images/float/telegram.gif" alt="logo" class="w-20 h-20  mx-auto" />
        </a>
        <a href="/landing/spin ">
            <img src="/public/assets/images/float/roda.gif" alt="logo" class="w-20 h-20 mx-auto" />
        </a>
    </div>

</template>

<script>
import { RouterLink } from "vue-router";
export default {
    components: {
        RouterLink
    },
}
</script>

<style>
.float {
    position: fixed;
    bottom: 2%;
    left: 91%;
    z-index: 999999;
    width: 100%;
    width: 7%;
    overflow-x: hidden;
    overflow-y: auto;
}

@media screen and (max-width: 768px) {
    .float {
        position: fixed;
        bottom: 2%;
        left: 77%;
        z-index: 999999;
        width: 100%;
        width: 22%;
        overflow-x: hidden;
        overflow-y: auto;
    }


}
</style>

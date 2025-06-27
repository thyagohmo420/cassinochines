<template>
    <div id="popup" v-if="$route.path === '/'" @click.prevent="closePopup()" class="popup relative">
        <div class="container">
            <p class="title">🤍Bônus de afiliado🤍</p>

            <p>🤍Bônus de Afiliado - cadastre-se na opção afilado🤍 <br>
Ao se cadastrar gere o link de afiliado e só indicar quem você preferir! E ganhe bônus quanto mais indicar ✅</p>

            <p>🤝 Nosso site é o unico oficial 👈</p>

            <p>🎁 Missões, participe de missões diárias e semanais para ganhar prêmios exclusivos! </p>

            <p>🧧 Basta se cadastrar como afiliado na nossa aba afiliado, clique em gerar codigo e receba seu painel avançado para acompanhar suas indicações e ganhe recompensas vitalícias com o novo sistema de afiliado!</p>
        </div>
        <div id="popup2"  style="z-index: 2;" class="close-btn absolute top-[66vh] md:top-[77vh]">
        <img src="/public/assets/images/Button - Close.svg" alt="">
    </div>
    </div>

</template>

<script>
export default {
  methods:{
    closePopup: function(){
        document.getElementById('popup').style="display:none"
        document.getElementById('popup2').style="display:none"
        document.body.classList.remove('no-scroll');
    }
  },
  mounted() {
    if (this.$route.path === '/') {
    document.body.classList.add('no-scroll');
  }
  }
}
</script>

<style>
.popup {
    position: relative;
    top: 0;
    left: 0;
    right: 0;
    z-index: 999999;
    width: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    justify-content: center;
    align-items: center;
    height: 100vh;
    display: flex;
    background-color: rgba(0, 0, 0, .45);
    filter: alpha(opacity = 50);
}
.container {
    padding: 20px;
    margin: 0 auto;
    border-radius: 25px;
    max-width: 436px;
    text-align: center;
    background-color: var(--ci-primary-color);
}

.no-scroll {
  overflow: hidden;
}

@media screen and (max-width: 768px) {
    .container {
        font-size: 10px;
        max-width: 91vw;
    }
}
</style>

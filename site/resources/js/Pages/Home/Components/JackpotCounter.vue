<template>
    <div class="jackpot-container">
      <img src="https://braddockpg.fun/public/assets/images/1786401504212652034.gif" alt="Jackpot" class="jackpot-image">
      <div class="jackpot-number">
        <b>{{ formattedValue }}</b>
      </div>
    </div>
  </template>
  <script>
  export default {
    data() {
      return {
        value: 1000, // Aqui você pode mudar de quando vai começar a contar
        targetValue: 100357346.27, // Aqui tu configura o valor final
      };
    },
    computed: {
      formattedValue() {
        return this.value.toLocaleString('en-US', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        });
      },
    },
    methods: {
    countUp() {
      const increment = (this.targetValue - this.value) / 100;
      this.value += increment > 1000 ? Math.min(increment, 123456.78) : Math.max(increment, -123456.78); // Aqui não precisa mexer, mas pode trocar o 1000 por algum numero que queira começar

      if (Math.abs(this.value - this.targetValue) < 1) {
        this.value = this.targetValue; 
      } else {
        requestAnimationFrame(this.countUp);
      }
    },
    updateTargetValue() {
      const min = 123456.78; // Aqui você usar pra ser o maximo e minimo que vai aparecer
      const max = 987654.32;
      this.targetValue = Math.random() * (max - min) + min;
      this.countUp();
    },
  },
  mounted() {
    this.countUp();
    setInterval(this.updateTargetValue, 30 * 60 * 1000); // Aqui tu configura o tempo pra atualizar
  },
  };
  </script>
  
  
  <style scoped>
   @import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inter:wght@100..900&family=Permanent+Marker&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

  .jackpot-container {
    position: relative;
    width: 100%; 
    max-width: 1140px; 
    margin: 0 auto; 
    height: auto; 
}
  .jackpot-image {
    width: 100%; 
    display: block; 
    height: auto; 
}
  .jackpot-number {
    position: absolute;
    top: 62%; 
    left: 50%; 
    transform: translate(-50%, -50%); 
    font-size: 4vw; 
    color: #fef136; 
    letter-spacing: 0.05em; 
    max-width: 100%;
   font-family: "Inter", sans-serif;
   font-optical-sizing: auto;
   font-weight: <weight>;
   font-style: normal;
   font-variation-settings: "slnt" 0;
  }
  </style>
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
      value: 1000, // Valor inicial
      targetValue: 100357346.27, // Valor final
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
      this.value += increment > 1000 ? Math.min(increment, 123456.78) : Math.max(increment, -123456.78);

      if (Math.abs(this.value - this.targetValue) < 1) {
        this.value = this.targetValue;
      } else {
        requestAnimationFrame(this.countUp);
      }
    },
    updateTargetValue() {
      const min = 123456.78; // Valor mínimo
      const max = 987654.32; // Valor máximo
      this.targetValue = Math.random() * (max - min) + min;
      this.countUp();
    },
  },
  mounted() {
    this.countUp();
    setInterval(this.updateTargetValue, 30 * 60 * 1000); // Atualiza a cada 30 minutos
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
  padding-left: 35px;
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
  font-size: 3.5vw;
  color: #fef136;
  letter-spacing: 0.05em;
  max-width: 100%;
  font-family: "Inter", sans-serif;
  font-weight: 700;
  font-style: normal;
}

@media (max-width: 768px) {
  .jackpot-number {
    font-size: 20px;
    padding-left: 25px;
  }
}
</style>

<template>
  <div class="loader">Loading...</div>
</template>

<script>
export default {
  name: 'ALoading'
};
</script>

<style lang="scss" scoped>
$spinnerOnColor: $mainColor;
$spinnerOffColor: #e0e0e0;
$bgColor: white;
$size: 28px;

.loader {
  text-indent: -9999em;
  width: $size;
  height: $size;
  border-radius: 50%;
  background: $spinnerOffColor;
  position: relative;
  -webkit-animation: load3 1.4s infinite linear;
  animation: load3 1.4s infinite linear;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}

.loader:before {
  width: 50%;
  height: 50%;
  background: $spinnerOnColor;
  border-radius: 100% 0 0 0;
  position: absolute;
  top: 0;
  left: 0;
  content: '';
}

.loader:after {
  background: $bgColor;
  width: 60%;
  height: 60%;
  border-radius: 50%;
  content: '';
  margin: auto;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

@-webkit-keyframes load3 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@keyframes load3 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>

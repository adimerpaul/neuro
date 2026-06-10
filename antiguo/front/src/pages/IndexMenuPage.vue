<template>
  <q-page>
    <div class="bannerMenu">
      <div class="q-pa-md text-white text-h4 text-bold">
        <div class="row">
          <div class="col-12 col-md-1 text-center">
            <q-img src="images/quir blanco2.png" width="50px" />
          </div>
          <div class="col-12 col-md-1 flex flex-center">
            <span class="text-subtitle1 q-pr-sm">Aula virtual </span>
          </div>
          <div class="col-12 col-md-7"></div>
          <div class="col-12 col-md-2 flex flex-center">
          </div>
        </div>
      </div>
    </div>
    <q-carousel
      :height="$q.screen.lt.md ? '40vh' : '35vh'"
      swipeable
      animated
      v-model="slide"
      arrows
      navigation-icon="radio_button_unchecked"
      class="q-mt-xs"
      infinite
      autoplay
      dark
    >
      <q-carousel-slide v-for="(t, i) in textos" :name="i+1" :key="i" class="column no-wrap flex-center" :img-src="t.img">
        <div class="text-center full-width q-pa-lg background">
          <div class="flex flex-center">
            <div class="titulo2 league-spartan">
              {{ t.titulo }}
            </div>
          </div>
          <div class="subtitulo league-spartan">
            {{ t.subtitulo }}
            <br>
            {{ t.fecha }}
          </div>
          <div>
          </div>
<!--          <div style="position: absolute; bottom: 0; right: 0; padding: 10px 10px 10px 10px;margin: 5px">-->
<!--            <div class="">-->
<!--              <img-->
<!--                class="demo-bg2"-->
<!--                src="images/fondoAzul.png"-->
<!--                alt=""-->
<!--              >-->
<!--              <div class="demo-content2">-->
<!--                <div class="flex flex-center">-->
<!--                  <q-img :src="t.imgButton" width="35px" />-->
<!--                  <div class="changa tituloCarrocel2" v-html="t.textButton">-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
        </div>
      </q-carousel-slide>
    </q-carousel>
    <div class="row q-pa-lg">
      <div class="col-12 flex flex-center">
        <iframe :width="$q.screen.lt.md ? '80%' : '70%'"
                height="400px" src="https://www.youtube.com/embed/fotAwmJo-Fc" title="JORNADAS Y SIMPOSIO NEROLOGÍA ORURO" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
    </div>
    <div>
      <div class="text-center">
        <span class="changa text-h6 text-bold text-white bg-grey-9 q-pa-xs borderRadius">
          CASAS AUSPICIADORAS
        </span>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="q-pa-lg text-center">
          <q-img src="images/oficial.jpeg" class="borderRadius" :width="$q.screen.lt.md ? '100%' : '70%'" />
        </div>
        <!--          <div class="q-pa-xs">-->
        <!--            <q-img src="logos/breskot pharma.png" width="80px"  />-->
        <!--          </div>-->
        <!--          <div class="q-pa-xs">-->
        <!--            <q-img src="logos/ferrer.png" width="80px"  />-->
        <!--          </div>-->
        <!--          <div class="q-pa-xs">-->
        <!--            <q-img src="logos/IMG_20230805_161256.jpg" width="60px"  />-->
        <!--          </div>-->
        <!--          <div class="q-pa-xs">-->
        <!--            <q-img src="logos/megalabs.png" width="80px"  />-->
        <!--          </div>-->
        <!--          <div class="q-pa-xs">-->
        <!--            <q-img src="logos/saval.png" width="55px"  />-->
        <!--          </div>-->
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'IndexPage',
  data () {
    return {
      modalMenu: false,
      slide: 1,
      textos: [
        {
          titulo: '5ta JORNADA NACIONAL DE NEUROLOGÍA',
          subtitulo: 'Avances en diagnóstico y tratamiento de enfermedades neurológicas',
          fecha: '12, 13, 14 de Junio',
          img: 'images/1.jpeg',
          imgButton: 'images/logoSBN3 mejorado.gif',
          textButton: 'Colegio Médico <br> De Oruro'
        },
        {
          titulo: '1er CURSO TALLER DE EXPLORACIÓN NEUROLÓGICA',
          subtitulo: 'Curso Teórico Práctico',
          fecha: '13 de Junio',
          img: 'images/3.jpg',
          imgButton: 'images/logoColMed3.png',
          textButton: 'Sociedad Boliviana <br> De Neurologia'
        },
        {
          titulo: 'TRANSMISIÓN EN VIVO Y AULA VIRTUAL',
          subtitulo: 'Transmisión en vivo de las jornadas',
          fecha: '12, 13, 14 de Junio',
          img: 'images/aula2.jpg',
          imgButton: 'images/quirquincho blanco.png',
          textButton: 'Neuro Oruro'
        }
      ]
    }
  }
})
</script>
<style>
.background {
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  height: 90vh;
}
.titulo2{
  padding: 5px;
  font-size: 30px;
  line-height: 1;
  letter-spacing: 1px;
  max-width: 600px;
}
.button{
  max-width: 100px;
  line-height: 1
}
.subtitulo{
  padding: 10px 30px;
  font-size: 30px;
}
.borderRadius{
  border-radius: 10px;
}
/*.bannerMenuxxx{
  background: url('/images/portadaTono3.jpg') no-repeat center center;
  background-size: cover;
}*/
.tituloCarrocel2{
  padding: 10px 20px 20px 10px;
  font-size: 10px;
  line-height: 1;
  letter-spacing: 1px;
  color: white;
}
.demo-wrap {
  overflow: hidden;
  position: relative;
}

.demo-bg2 {
  opacity: 0.5;
  position: absolute;
  left: -30px;
  top: 10px;
  width: 100%;
}
.demo-content2 {
  position: relative;
}
@media (max-width: 1024px) {
  .titulo{
    padding: 50px 0px 0px 0px;
    font-size: 25px;
    font-weight: 900;
  }
  .subtitulo{
    padding: 5px 10px;
    font-size: 15px;
    font-weight: 900;
  }
  .textMenu{
    font-size: 20px;
  }
}
</style>

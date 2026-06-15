<template>
  <q-page>
    <div class="bannerMenu full-width">
      <div class="q-pa-md text-white text-h4 text-bold">
        <div class="row">
          <div class="col-12 col-md-1 text-center">
            <q-img src="images/quirquincho web.png" width="70px"/>
          </div>
          <div class="col-12 col-md-2">
            <!--                <span class="text-subtitle1 q-pr-sm">Aula virtual </span>-->
            <span class="text-center textMenu changa text-primary">
                  Neuro Oruro
                </span>
          </div>
          <div class="col-12 col-md-7"></div>
          <div class="col-12 col-md-2 flex flex-center">
            <div class="text-right">
              <q-input
                outlined
                dense
                placeholder="Buscar"
                bg-color="white"
                border-color="white"
                clearable
                style="border: 5px solid #001B2C"
              >
                <template v-slot:append>
                  <!--                  <div class="bg-blue">-->
                  <q-icon name="search"/>
                  <!--                  </div>-->
                </template>
              </q-input>
            </div>
          </div>
        </div>
      </div>
    </div>
    <q-carousel
      :height="$q.screen.lt.md ? '40vh' : '60vh'"
      swipeable
      animated
      v-model="slide"
      arrows
      infinite
      autoplay
    >
      <q-carousel-slide v-for="(t, i) in textos" :name="i+1" :key="i" class="column no-wrap flex-center" :img-src="t.img">
        <div class="text-center full-width q-pa-lg background">
          <div class="flex flex-center">
            <div class="titulo league-spartan ">
              {{ t.titulo }}
            </div>
          </div>
          <div class="subtitulo league-spartan ">
            {{ t.subtitulo }}
            <br>
            {{ t.fecha }}
          </div>
          <div>
            <q-btn color="primary" class="q-mt-md " rounded no-caps to="/login" >
              <div class="changa button">Ingresa Aqui</div>
            </q-btn>
<!--            <q-btn color="primary" class="q-mt-md " rounded no-caps to="/inscripcion" >-->
<!--              <div class="changa button">Inscribirse</div>-->
<!--            </q-btn>-->
          </div>
          <div style="position: absolute; top: 10px; right: 10px; padding: 0;margin: 5px;width: 150px;line-height: 0.9;">
            <div style="display: flex; align-items: center; justify-content: center;">
              <div class="changa" v-html="t.textButton">
              </div>
              <q-img :src="t.imgButton" width="45px"/>
            </div>
            <!--            <div class="flex flex-center">-->
            <!--                <q-img :src="t.imgButton" width="45px" />-->
            <!--                <div class="changa tituloCarrocel" v-html="t.textButton">-->
            <!--                </div>-->
            <!--            </div>-->
<!--            <div class="">-->
<!--              <img-->
<!--                class="demo-bg"-->
<!--                src="images/fondoAzul.png"-->
<!--                alt=""-->
<!--              >-->
<!--              <div class="demo-content">-->
<!--                <div class="flex flex-center">-->
<!--                  <q-img :src="t.imgButton" width="45px"/>-->
<!--                  <div class="changa tituloCarrocel" v-html="t.textButton">-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
          </div>
<!--                    <q-img src="images/logoColMed3.png" width="30px" />-->
<!--                    <div class="changa tituloCarrocel">-->
<!--                      Colegio Medico Oruro-->
<!--                    </div>-->
        </div>
      </q-carousel-slide>
      <!--      <template v-slot:control>-->
      <!--        <q-carousel-control-->
      <!--          position="bottom-right"-->
      <!--          :offset="[18, 18]"-->
      <!--          class="text-white rounded-borders"-->
      <!--          style="background: rgba(0, 0, 0, .3); padding: 4px 8px;"-->
      <!--        >-->
      <!--          <q-img src="images/logoColMed3.png" width="30px" />-->
      <!--          <div class="changa tituloCarrocel">-->
      <!--            Colegio Medico Oruro-->
      <!--          </div>-->
      <!--        </q-carousel-control>-->
      <!--      </template>-->
    </q-carousel>
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
          titulo: '1er SIMPOSIO INTERNACIONAL DE ENFERMEDAD CEREBROVASCULAR EN LA ALTURA',
          subtitulo: '"Oruro Contra el Ictus: Actualización, Código Ictus y Prevención primaria"',
          fecha: '23, 24 y 25 de Julio 2026 · Oruro, Bolivia',
          img: 'images/1.jpeg',
          imgButton: 'images/logoSBN3 mejorado.gif',
          textButton: 'Sociedad Boliviana <br> de Neurología'
        },
        {
          titulo: '1er SEMINARIO-TALLER CÓDIGO ICTUS Y MANEJO HOSPITALARIO',
          subtitulo: 'Formación práctica intensiva en protocolo código ictus y manejo hospitalario',
          fecha: '24 de Julio 2026 · Hospital Gral. San Juan de Dios · Oruro',
          img: 'images/3.jpg',
          imgButton: 'images/logoColMed3.png',
          textButton: 'Colegio Médico <br> de Oruro'
        },
        {
          titulo: 'MODALIDAD HÍBRIDA — PRESENCIAL Y VIRTUAL',
          subtitulo: 'Transmisión en vivo de todas las jornadas del simposio',
          fecha: '23, 24 y 25 de Julio 2026',
          img: 'images/aula2.jpg',
          imgButton: 'images/quirquincho blanco.png',
          textButton: 'NeuroOruro <br> 2026'
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

.titulo {
  padding: 10px;
  font-size: 50px;
  line-height: 1.5;
  letter-spacing: 1px;
  max-width: 750px;
}

.button {
  max-width: 100px;
  line-height: 1
}

.subtitulo {
  padding: 10px 30px;
  font-size: 30px;
}

.borderRadius {
  border-radius: 10px;
}
.bannerMenu{
  background: url('/images/franja.jpg') no-repeat center center;
  background-size: cover;
}

.tituloCarrocel {
  padding: 20px 30px 30px 20px;
  font-size: 15px;
  line-height: 1;
  letter-spacing: 1px;
  color: white;
}

.demo-wrap {
  overflow: hidden;
  position: relative;
}

.demo-bg {
  opacity: 0.5;
  position: absolute;
  left: -30px;
  top: 10px;
  width: 100%;
}

.demo-content {
  position: relative;
}

@media (max-width: 1024px) {
  .titulo {
    padding: 50px 0px 0px 0px;
    font-size: 25px;
    font-weight: 900;
  }

  .subtitulo {
    padding: 5px 10px;
    font-size: 15px;
    font-weight: 900;
  }

  .textMenu {
    font-size: 20px;
  }
}
</style>

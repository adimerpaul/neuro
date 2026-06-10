<template>
  <q-page class="fondo q-pa-lg">
    <div class="row justify-center">
      <div class="col-12 col-md-10">
        <q-card class="q-pa-md bg-grey-2">
          <q-card-section class="text-h4 fondo">
            <div class="text-center text-bold text-white">
              CONTACTOS
            </div>
          </q-card-section>

          <q-card-section class="q-mt-md">
            <div class="row q-col-gutter-md q-px-md">

              <!-- Facebook -->
              <div class="col-12 col-md-4">
                <q-btn type="a" target="_blank"
                       href="https://www.facebook.com/profile.php?id=100068249745954"
                       color="primary" class="full-width q-pa-sm" rounded outline>
                  <q-icon name="fa-brands fa-facebook" size="md" class="q-mr-sm" />
                  <span class="text-subtitle2 text-weight-medium">Facebook<br>5ta Jornada Nacional de Neurología</span>
                </q-btn>
              </div>

              <!-- WhatsApp -->
              <div class="col-12 col-md-4">
                <q-btn flat dense class="full-width q-pa-sm text-left text-green-8" style="cursor: default">
                  <q-icon name="fa-brands fa-whatsapp" size="md" class="q-mr-sm" />
                  <div class="text-subtitle2 text-weight-medium">
                    Cel: 7247581<br>
                    Cel: 61823204<br>
                    Cel: 60401730
                  </div>
                </q-btn>
              </div>

              <!-- Página Web -->
              <div class="col-12 col-md-4">
                <q-btn flat dense class="full-width q-pa-sm text-left text-blue-9" style="cursor: default">
                  <q-icon name="o_public" size="md" class="q-mr-sm" />
                  <div class="text-subtitle2 text-weight-medium">
                    Página web:<br>
                    <a href="https://jornadasimposioneurooruro.org/" target="_blank"
                       class="text-primary text-underline">
                      jornadasimposioneurooruro.org
                    </a>
                  </div>
                </q-btn>
              </div>

            </div>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>
<style scoped>
.fondo {
  background-image: url("/images/plomoOscuro.jpeg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}
</style>

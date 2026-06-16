<template>
  <q-footer>
    <div class="bg-grey-3">
      <div class="row q-pa-lg">
        <!-- Facebook -->
        <div class="col-6 col-md-3 flex flex-center">
          <q-btn type="a" target="_blank" href="https://www.facebook.com/profile.php?id=100068249745954" flat dense
                 size="22px" color="primary" class="q-ma-md">
            <div class="row items-center no-wrap">
              <q-icon left name="fa-brands fa-facebook" />
              <div class="text-left text-grey text-subtitle2 text-bold" style="line-height: 1.2;">
                Facebook<br>NeuroOruro 2026
              </div>
            </div>
          </q-btn>
        </div>

        <!-- Logo -->
        <div class="col-6 col-md-3 flex flex-center">
          <q-img src="/images/mejorado.png" width="100px" class="cursor-pointer"
                 @click="$router.push('/')"
          />
        </div>

        <!-- Simposio Principal -->
        <div class="col-6 col-md-3">
          <div class="text-grey text-bold text-center">
            1er Simposio Internacional de Enfermedad Cerebrovascular en la Altura
          </div>
          <q-separator />
          <div class="text-grey text-center">
            "Oruro Contra el Ictus: Actualización, Código Ictus y Prevención primaria"
          </div>
          <div class="text-grey text-center">23, 24 y 25 de Julio 2026</div>
          <div class="text-grey text-center text-caption">Colegio Médico de Oruro — Villarroel y Vasquez</div>
        </div>

        <!-- Seminario-Taller -->
        <div class="col-6 col-md-3">
          <div class="text-grey text-bold text-center">
            1er Seminario-Taller Código Ictus y Manejo Hospitalario
          </div>
          <q-separator />
          <div class="text-grey text-center">24 de Julio 2026</div>
          <div class="text-grey text-center text-caption">Auditorio Hospital Gral. San Juan de Dios</div>
        </div>
      </div>
    </div>
  </q-footer>
</template>

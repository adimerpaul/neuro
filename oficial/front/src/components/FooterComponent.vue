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
                Facebook<br>5ta. Jornada Nacional de Neurología
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

        <!-- Jornada Principal -->
        <div class="col-6 col-md-3">
          <div class="text-grey text-bold text-center">
            5ta Jornada Nacional de Neurología
          </div>
          <q-separator />
          <div class="text-grey text-center">
            “Avances en diagnóstico y tratamiento de enfermedades neurológicas”
          </div>
          <div class="text-grey text-center">12, 13 y 14 de Junio 2025</div>
          <div class="text-grey text-center text-caption">Auditorio Clínica San Agustín</div>
        </div>

        <!-- Curso Taller -->
        <div class="col-6 col-md-3">
          <div class="text-grey text-bold text-center">
            1er Curso Taller de Exploración Neurológica
          </div>
          <q-separator />
          <div class="text-grey text-center">13 de Junio</div>
          <div class="text-grey text-center text-caption">Coordinador: Dr. Jaime López</div>
        </div>
      </div>
    </div>
  </q-footer>
</template>

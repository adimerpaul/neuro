@extends('layouts.app')

@section('content')

<!-- ===================== NAV ===================== -->
<header class="nav" id="nav">
  <div class="wrap nav-inner">
    <a href="#inicio" class="brand">
      <div class="mark">SBN</div>
      <div class="txt">
        <b>Jornada Nacional de Neurología</b>
        <span>Oruro · Bolivia · 2023</span>
      </div>
    </a>
    <nav class="nav-links" id="navLinks">
      <a href="#eventos">Eventos</a>
      <a href="#programa">Programa</a>
      <a href="#costos">Costos</a>
      <a href="#inscripcion">Inscripción</a>
      <a href="#contacto">Contacto</a>
    </nav>
    <div class="nav-cta">
      <a href="#inscripcion" class="btn btn-primary">Inscríbete</a>
      <button class="menu-toggle" id="menuToggle" aria-label="Menú"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>

<!-- ===================== HERO ===================== -->
<section class="hero" id="inicio">
  <canvas id="neural"></canvas>
  <div class="wrap">
    <div class="hero-grid">
      <div class="hero-copy">
        <div class="hero-badges">
          <span class="pill"><span class="dot"></span> Presencial · Oruro</span>
          <span class="pill"><span class="dot"></span> Virtual vía ZOOM</span>
          <span class="pill accent"><span class="dot"></span> Cupos limitados</span>
        </div>
        <h1>
          <small>4ta Jornada Nacional de Neurología</small>
          Actualizaciones en <span class="grad">enfermedades neurológicas</span>
        </h1>
        <p class="sub">Un encuentro académico de alto nivel que reúne a especialistas, médicos, residentes y estudiantes en torno a los avances de la neurología clínica y las emergencias neurológicas.</p>
        <div class="tagline">
          <svg class="eeg" viewBox="0 0 64 24"><path d="M0 12 H14 L18 4 L22 20 L26 12 H38 L42 6 L46 18 L50 12 H64"/></svg>
          <span>"Desde Oruro, Bolivia para el mundo"</span>
        </div>
        <div class="hero-cta">
          <a href="#inscripcion" class="btn btn-primary">Quiero inscribirme →</a>
          <a href="#programa" class="btn btn-ghost">Ver programa</a>
        </div>
      </div>

      <aside class="count-card">
        <div class="ct-label">Cuenta regresiva</div>
        <div class="ct-event">Inauguración de la Jornada · 13 de septiembre</div>
        <div class="count-grid" id="countdown">
          <div class="ct-cell"><b id="cd-d">00</b><span>días</span></div>
          <div class="ct-cell"><b id="cd-h">00</b><span>horas</span></div>
          <div class="ct-cell"><b id="cd-m">00</b><span>min</span></div>
          <div class="ct-cell"><b id="cd-s">00</b><span>seg</span></div>
        </div>
        <div class="ct-foot">
          <span>"El poder de tus brazos Oruro"</span>
          <b>5 días<br>de academia</b>
        </div>
      </aside>
    </div>

    <div class="hero-orgs">
      <span class="lbl">Organizan</span>
      <div class="org">
        <div class="badge">SBN</div>
        <small>Sociedad Boliviana<br>de Neurología · 1975</small>
      </div>
      <div class="org">
        <div class="badge">CMO</div>
        <small>Colegio Médico<br>de Oruro</small>
      </div>
    </div>
  </div>
</section>

<!-- ===================== EVENTOS ===================== -->
<section class="section events" id="eventos">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Dos eventos · una sede</span>
      <h2>Cinco días dedicados al cerebro y al sistema nervioso</h2>
      <p>La Jornada Nacional y el Simposio Internacional se desarrollan de forma consecutiva, en modalidad híbrida: asiste de manera presencial en Oruro o conéctate en vivo desde cualquier lugar del mundo.</p>
    </div>
    <div class="ev-grid">
      <article class="ev-card feature">
        <span class="ev-glow"></span>
        <span class="ev-num">4ta Jornada Nacional</span>
        <h3>Jornada Nacional de Neurología</h3>
        <p class="ev-theme">Actualizaciones en enfermedades neurológicas — conferencias magistrales, casos clínicos y mesas de debate con referentes nacionales.</p>
        <div class="ev-meta">
          <div class="ev-date-big"><small>Septiembre 2023</small>13 · 14 · 15</div>
          <div class="ev-row"><div class="ico">📍</div><span>Presencial en Oruro + Virtual vía ZOOM</span></div>
        </div>
      </article>
      <article class="ev-card">
        <span class="ev-glow"></span>
        <span class="ev-num">2do Simposio Internacional</span>
        <h3>Simposio de Emergencias Neurológicas</h3>
        <p class="ev-theme">Manejo de las urgencias neurológicas con invitados internacionales: stroke, status epiléptico, trauma y cuidado neurocrítico.</p>
        <div class="ev-meta">
          <div class="ev-date-big"><small>Septiembre 2023</small>16 · 17</div>
          <div class="ev-row"><div class="ico">💻</div><span>Modalidad Virtual vía ZOOM</span></div>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ===================== PROGRAMA ===================== -->
<section class="section programa" id="programa">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Programa académico</span>
      <h2>Cronograma por días</h2>
      <p>Navega el programa de cada jornada. Las conferencias presenciales se transmiten simultáneamente por ZOOM.</p>
      <div class="prog-note">⚠ Programa preliminar — sujeto a confirmación de horarios y disertantes</div>
    </div>

    <div class="tabs" id="tabs">
      <button class="tab active" data-tab="d1"><small>MIÉ · JORNADA</small><b>13 sep</b></button>
      <button class="tab" data-tab="d2"><small>JUE · JORNADA</small><b>14 sep</b></button>
      <button class="tab" data-tab="d3"><small>VIE · JORNADA</small><b>15 sep</b></button>
      <button class="tab sim" data-tab="d4"><small>SÁB · SIMPOSIO</small><b>16 sep</b></button>
      <button class="tab sim" data-tab="d5"><small>DOM · SIMPOSIO</small><b>17 sep</b></button>
    </div>

    <div class="panel active" id="d1">
      <div class="panel-head"><h3>Día 1 · Inauguración</h3><span class="ph-tag">4ta Jornada Nacional</span></div>
      <div class="sched">
        <div class="slot"><div class="time">08:00<small>—09:00</small></div><div class="topic"><b>Acreditación y entrega de credenciales</b><span>Registro de asistentes presenciales y habilitación de sala virtual.</span></div></div>
        <div class="slot"><div class="time">09:00<small>—09:45</small></div><div class="topic"><b>Acto inaugural</b><span>Palabras de la Sociedad Boliviana de Neurología y el Colegio Médico de Oruro.</span></div></div>
        <div class="slot"><div class="time">10:00<small>—12:30</small></div><div class="topic"><b>Módulo: Enfermedad cerebrovascular</b><span>Conferencias magistrales y discusión de casos clínicos.</span></div></div>
        <div class="slot break"><div class="time">12:30<small>—14:00</small></div><div class="topic"><b>Receso · almuerzo</b></div></div>
        <div class="slot"><div class="time">14:00<small>—17:30</small></div><div class="topic"><b>Módulo: Epilepsia y trastornos del movimiento</b><span>Actualización diagnóstica y terapéutica.</span></div></div>
      </div>
    </div>
    <div class="panel" id="d2">
      <div class="panel-head"><h3>Día 2 · Neurología clínica</h3><span class="ph-tag">4ta Jornada Nacional</span></div>
      <div class="sched">
        <div class="slot"><div class="time">08:30<small>—10:30</small></div><div class="topic"><b>Módulo: Cefaleas y dolor neuropático</b><span>Abordaje práctico para el médico general.</span></div></div>
        <div class="slot"><div class="time">10:30<small>—12:30</small></div><div class="topic"><b>Módulo: Enfermedades desmielinizantes</b><span>Esclerosis múltiple y trastornos relacionados.</span></div></div>
        <div class="slot break"><div class="time">12:30<small>—14:00</small></div><div class="topic"><b>Receso · almuerzo</b></div></div>
        <div class="slot"><div class="time">14:00<small>—17:00</small></div><div class="topic"><b>Módulo: Neuroinfectología</b><span>Casos en altura y patología regional.</span></div></div>
      </div>
    </div>
    <div class="panel" id="d3">
      <div class="panel-head"><h3>Día 3 · Cierre de la Jornada</h3><span class="ph-tag">4ta Jornada Nacional</span></div>
      <div class="sched">
        <div class="slot"><div class="time">08:30<small>—10:30</small></div><div class="topic"><b>Módulo: Deterioro cognitivo y demencias</b><span>Diagnóstico temprano y manejo integral.</span></div></div>
        <div class="slot"><div class="time">10:30<small>—12:30</small></div><div class="topic"><b>Mesa redonda interdisciplinaria</b><span>Neurología, psiquiatría y rehabilitación.</span></div></div>
        <div class="slot break"><div class="time">12:30<small>—14:00</small></div><div class="topic"><b>Receso · almuerzo</b></div></div>
        <div class="slot"><div class="time">14:00<small>—16:30</small></div><div class="topic"><b>Trabajos libres y conclusiones</b><span>Presentación de pósters y clausura de la Jornada.</span></div></div>
      </div>
    </div>
    <div class="panel" id="d4">
      <div class="panel-head"><h3>Día 4 · Apertura del Simposio</h3><span class="ph-tag sim">2do Simposio Internacional</span></div>
      <div class="sched">
        <div class="slot"><div class="time">09:00<small>—09:30</small></div><div class="topic"><b>Apertura del Simposio Internacional</b><span>Conexión simultánea con invitados del exterior.</span></div></div>
        <div class="slot"><div class="time">09:30<small>—12:30</small></div><div class="topic"><b>Emergencia: Stroke agudo</b><span>Código ictus, trombólisis y trombectomía.</span></div></div>
        <div class="slot break"><div class="time">12:30<small>—14:00</small></div><div class="topic"><b>Receso</b></div></div>
        <div class="slot"><div class="time">14:00<small>—17:00</small></div><div class="topic"><b>Status epiléptico y crisis</b><span>Protocolos de manejo en urgencias.</span></div></div>
      </div>
    </div>
    <div class="panel" id="d5">
      <div class="panel-head"><h3>Día 5 · Cierre internacional</h3><span class="ph-tag sim">2do Simposio Internacional</span></div>
      <div class="sched">
        <div class="slot"><div class="time">09:00<small>—11:30</small></div><div class="topic"><b>Cuidado neurocrítico</b><span>Manejo del paciente neurológico grave.</span></div></div>
        <div class="slot"><div class="time">11:30<small>—13:00</small></div><div class="topic"><b>Trauma craneoencefálico</b><span>Decisiones en la urgencia y derivación.</span></div></div>
        <div class="slot break"><div class="time">13:00<small>—14:00</small></div><div class="topic"><b>Receso</b></div></div>
        <div class="slot"><div class="time">14:00<small>—16:00</small></div><div class="topic"><b>Conclusiones y entrega de certificados</b><span>Clausura del Simposio Internacional.</span></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== COSTOS ===================== -->
<section class="section costos" id="costos">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Inversión</span>
      <h2>Costos de inscripción</h2>
      <p>La inscripción incluye acceso a la Jornada Nacional y al Simposio Internacional, material académico y certificado digital. Precios en bolivianos (Bs).</p>
    </div>
    <div class="cost-grid">
      <div class="cost-card pop">
        <span class="cost-tag">Completo</span>
        <h4>Especialidades</h4>
        <div class="cost-price"><small>Bs</small>350</div>
        <div class="cost-foot">Jornada + Simposio + certificado</div>
      </div>
      <div class="cost-card">
        <h4>Médicos generales</h4>
        <div class="cost-price"><small>Bs</small>200</div>
        <div class="cost-foot">Acceso a ambos eventos</div>
      </div>
      <div class="cost-card">
        <h4>Lic. de enfermería y residentes</h4>
        <div class="cost-price"><small>Bs</small>150</div>
        <div class="cost-foot">Acceso a ambos eventos</div>
      </div>
      <div class="cost-card">
        <h4>Estudiantes y otros</h4>
        <div class="cost-price"><small>Bs</small>100</div>
        <div class="cost-foot">Con credencial vigente</div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== INSCRIPCION ===================== -->
<section class="section inscripcion" id="inscripcion">
  <span class="ev-glow"></span>
  <div class="wrap">
    <div class="ins-grid">
      <div class="ins-info">
        <span class="eyebrow">Reserva tu lugar</span>
        <h2>Inscríbete a la Jornada y al Simposio</h2>
        <p>Completa el formulario para reservar tu cupo. Luego realiza el depósito o transferencia y envía tu comprobante por WhatsApp para confirmar tu participación.</p>

        <div class="pay-box">
          <h4>💳 Modos de pago — Depósito o transferencia</h4>
          <div class="pay-rows">
            <div class="pay-row"><span>Entidad</span><b>Banco Unión S.A.</b></div>
            <div class="pay-row"><span>N.º de cuenta</span><b class="acct">10000034276390</b></div>
            <div class="pay-row"><span>Titular</span><b>Raquel Madaín Prieto</b></div>
            <div class="pay-row"><span>Comprobante</span><b>Enviar por WhatsApp</b></div>
          </div>
        </div>
      </div>

      <div class="form-card">
        <form id="regForm" novalidate>
          @csrf
          <h3>Formulario de inscripción</h3>
          <p class="fc-sub">Completa tus datos y te contactaremos para confirmar.</p>

          <div class="field-row">
            <div class="field">
              <label for="f-firstName">Nombre(s)</label>
              <input type="text" id="f-firstName" name="firstName" placeholder="Ej. Ana" required />
            </div>
            <div class="field">
              <label for="f-firstSurname">Apellido paterno</label>
              <input type="text" id="f-firstSurname" name="firstSurname" placeholder="Ej. Quispe" required />
            </div>
          </div>
          <div class="field-row">
            <div class="field">
              <label for="f-email">Correo electrónico</label>
              <input type="email" id="f-email" name="email" placeholder="tu@correo.com" required />
            </div>
            <div class="field">
              <label for="f-phone">Celular / WhatsApp</label>
              <input type="tel" id="f-phone" name="phone" placeholder="Ej. 70000000" required />
            </div>
          </div>
          <div class="field-row">
            <div class="field">
              <label for="f-profession">Categoría</label>
              <select id="f-profession" name="profession" required>
                <option value="" disabled selected>Selecciona…</option>
                <option value="Especialidad — Bs350">Especialidad — Bs350</option>
                <option value="Médico general — Bs200">Médico general — Bs200</option>
                <option value="Lic. enfermería / Residente — Bs150">Lic. enfermería / Residente — Bs150</option>
                <option value="Estudiante u otros — Bs100">Estudiante u otros — Bs100</option>
              </select>
            </div>
            <div class="field">
              <label for="f-modalidad">Modalidad</label>
              <select id="f-modalidad" name="modalidad" required>
                <option value="" disabled selected>Selecciona…</option>
                <option value="Presencial — Oruro">Presencial — Oruro</option>
                <option value="Virtual — ZOOM">Virtual — ZOOM</option>
              </select>
            </div>
          </div>
          <div class="field">
            <label for="f-ciudad">Ciudad / País</label>
            <input type="text" id="f-ciudad" name="ciudad" placeholder="Ej. Oruro, Bolivia" />
          </div>
          <div id="form-error" class="form-error" style="display:none"></div>
          <button type="submit" class="btn btn-primary" id="submitBtn">Reservar mi cupo →</button>
        </form>

        <div class="form-success" id="formSuccess">
          <div class="check">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
          </div>
          <h3>¡Inscripción registrada!</h3>
          <p id="successMsg">Gracias por inscribirte. Realiza el pago y envía tu comprobante por WhatsApp para confirmar tu cupo.</p>
          <a href="#" id="successWa" class="btn btn-dark" target="_blank" rel="noopener">Enviar comprobante por WhatsApp</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== AUSPICIADORES ===================== -->
<section class="section sponsors" id="auspiciadores">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">Con el respaldo de</span>
      <h2>Auspiciadores</h2>
    </div>
    <div class="sp-grid">
      <div class="sp"><small>Laboratorio</small>Bagó</div>
      <div class="sp"><small>Pharma</small>Breskot</div>
      <div class="sp"><small>Laboratorio</small>Megalabs</div>
      <div class="sp"><small>Laboratorio</small>Saval</div>
      <div class="sp"><small>Laboratorio</small>Ferrer</div>
      <div class="sp"><small>Laboratorio</small>Prestat</div>
      <div class="sp"><small>Laboratorio</small>Talflex</div>
    </div>
  </div>
</section>

<!-- ===================== FOOTER ===================== -->
<footer id="contacto">
  <div class="wrap">
    <div class="foot-grid">
      <div class="foot-brand">
        <a href="#inicio" class="brand">
          <div class="mark">SBN</div>
          <div class="txt"><b>Jornada Nacional de Neurología</b><span>Oruro · Bolivia · 2023</span></div>
        </a>
        <p>4ta Jornada Nacional de Neurología y 2do Simposio Internacional de Emergencias Neurológicas. Desde Oruro, Bolivia para el mundo.</p>
      </div>
      <div class="foot-col">
        <h5>Informes</h5>
        <p class="foot-phones">72475801</p>
        <p class="foot-phones">61823204</p>
        <p class="foot-phones">60401731</p>
        <a href="#inscripcion">Inscripciones</a>
      </div>
      <div class="foot-col">
        <h5>Navegación</h5>
        <a href="#eventos">Eventos</a>
        <a href="#programa">Programa</a>
        <a href="#costos">Costos</a>
        <a href="#auspiciadores">Auspiciadores</a>
      </div>
    </div>
    <div class="foot-bottom">
      <span>© 2023 Sociedad Boliviana de Neurología · Colegio Médico de Oruro</span>
      <span>"El poder de tus brazos Oruro"</span>
    </div>
  </div>
</footer>

<!-- ===================== WHATSAPP FAB ===================== -->
<a href="https://wa.me/59172475801?text=Hola,%20quiero%20información%20sobre%20la%204ta%20Jornada%20Nacional%20de%20Neurología"
   class="wa-fab" target="_blank" rel="noopener" aria-label="Informes por WhatsApp">
  <svg viewBox="0 0 24 24" fill="currentColor">
    <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.739-.981 0 .001zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
  </svg>
  <span class="wa-txt">Informes por WhatsApp</span>
</a>

@endsection

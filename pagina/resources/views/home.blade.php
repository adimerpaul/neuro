@extends('layouts.app')

@section('content')

<!-- ===================== NAV ===================== -->
<header class="nav" id="nav">
  <div class="wrap nav-inner">
    <a href="#inicio" class="brand">
{{--      <div class="mark">SBN</div>--}}
        <div class="mark">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo NeuroOruro 2026" class="logo">
        </div>
      <div class="txt">
        <b>NeuroOruro 2026</b>
        <span>¡Ciencia que conecta, salud que transforma!</span>
      </div>
    </a>
    <nav class="nav-links" id="navLinks">
      <a href="#eventos">Eventos</a>
      <a href="#programa">Programa</a>
      <a href="#costos">Costos</a>
      <a href="/inscripcion">Inscripción</a>
      <a href="{{ route('ingresar') }}">Ingresar</a>
      <a href="#contacto">Contacto</a>
    </nav>
    <div class="nav-cta">
      <a href="{{ route('ingresar') }}" class="btn btn-ghost">@auth Panel @else Ingresar @endauth</a>
      <a href="/inscripcion" class="btn btn-primary">Inscríbete</a>
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
          <span class="pill"><span class="dot"></span> Virtual — Modalidad Híbrida</span>
          <span class="pill accent"><span class="dot"></span> Cupos limitados</span>
        </div>
        <h1>
          <small>NeuroOruro · Oruro, Bolivia · 2026</small>
          Dos grandes eventos, <span class="grad">una misma misión</span>
        </h1>
        <p class="sub">Proteger el cerebro, salvar vidas. El 1er Simposio Internacional de Enfermedad Cerebrovascular en la Altura y el 1er Seminario-Taller Código Ictus y Manejo Hospitalario se unen en Oruro en julio de 2026.</p>
        <div class="tagline">
          <svg class="eeg" viewBox="0 0 64 24"><path d="M0 12 H14 L18 4 L22 20 L26 12 H38 L42 6 L46 18 L50 12 H64"/></svg>
          <span>"¡Ciencia que conecta, salud que transforma!"</span>
        </div>
        <div class="hero-cta">
          <a href="/inscripcion" class="btn btn-primary">Quiero inscribirme →</a>
          <a href="{{ route('ingresar') }}" class="btn btn-ghost">@auth Ir al panel @else Ingresar @endauth</a>
          <a href="#programa" class="btn btn-ghost">Ver programa</a>
        </div>
      </div>

      <aside class="count-card">
        <div class="ct-label">Cuenta regresiva</div>
        <div class="ct-event">Inauguración del Simposio · 23 de julio 2026</div>
        <div class="count-grid" id="countdown">
          <div class="ct-cell"><b id="cd-d">00</b><span>días</span></div>
          <div class="ct-cell"><b id="cd-h">00</b><span>horas</span></div>
          <div class="ct-cell"><b id="cd-m">00</b><span>min</span></div>
          <div class="ct-cell"><b id="cd-s">00</b><span>seg</span></div>
        </div>
        <div class="ct-foot">
          <span>"El poder de tus brazos Oruro"</span>
          <b>3 días<br>de academia</b>
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
      <span class="eyebrow">Dos grandes eventos · una misma misión</span>
      <h2>Proteger el cerebro, salvar vidas</h2>
      <p>Julio de 2026 en Oruro — modalidad híbrida: asiste de manera presencial o conéctate en vivo desde cualquier lugar del mundo.</p>
    </div>
    <div class="ev-grid">
      <article class="ev-card feature">
        <span class="ev-glow"></span>
        <span class="ev-num">1er Simposio Internacional</span>
        <h3>Enfermedad Cerebrovascular en la Altura</h3>
        <p class="ev-theme">"Oruro Contra el Ictus: Actualización, Código Ictus y Prevención primaria" — conferencias magistrales con expertos nacionales e internacionales.</p>
        <div class="ev-meta">
          <div class="ev-date-big"><small>Julio 2026</small>23 · 24 · 25</div>
          <div class="ev-row"><div class="ico">📍</div><span>Colegio Médico de Oruro — Villarroel y Vasquez</span></div>
          <div class="ev-row"><div class="ico">🏥</div><span>Capacitación: Auditorio Hospital Gral. San Juan de Dios</span></div>
          <div class="ev-row"><div class="ico">🕘</div><span>09:00 AM – 05:30 PM · Modalidad Híbrida</span></div>
          <div class="ev-row"><div class="ico">👥</div><span>Dirigido a: Neurólogos, médicos de emergencias, enfermeros, técnicos en emergencias médicas, laboratorio, imagenología, personal de ambulancia, administrativos de triaje.</span></div>
        </div>
      </article>
      <article class="ev-card">
        <span class="ev-glow"></span>
        <span class="ev-num">1er Seminario - Taller</span>
        <h3>Código Ictus y Manejo Hospitalario</h3>
        <p class="ev-theme">Formación práctica intensiva en el reconocimiento, activación y manejo del código ictus en el entorno hospitalario boliviano.</p>
        <div class="ev-meta">
          <div class="ev-date-big"><small>Julio 2026</small>24</div>
          <div class="ev-row"><div class="ico">🏥</div><span>Auditorio Hospital Gral. San Juan de Dios de Oruro</span></div>
          <div class="ev-row"><div class="ico">💻</div><span>Modalidad Híbrida (presencial + virtual)</span></div>
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
      <h2>Cronograma — Julio 2026</h2>
      <p>Navega el programa de cada jornada. Las actividades presenciales se transmiten simultáneamente en modalidad virtual.</p>
      <div class="prog-note">⚠ Programa preliminar — sujeto a confirmación de horarios y disertantes</div>
    </div>

    <div class="tabs" id="tabs">
      <button class="tab active" data-tab="d1"><small>JUE · SIMPOSIO</small><b>23 jul</b></button>
      <button class="tab" data-tab="d2"><small>VIE · SIMPOSIO + TALLER</small><b>24 jul</b></button>
      <button class="tab sim" data-tab="d3"><small>SÁB · SIMPOSIO</small><b>25 jul</b></button>
    </div>

    <div class="panel active" id="d1">
      <div class="panel-head"><h3>Día 1 · Inauguración del Simposio</h3><span class="ph-tag">1er Simposio Internacional</span></div>
      <div class="sched">
        <div class="slot"><div class="time">08:00<small>—09:00</small></div><div class="topic"><b>Acreditación y entrega de credenciales</b><span>Registro de asistentes presenciales y habilitación de sala virtual.</span></div></div>
        <div class="slot"><div class="time">09:00<small>—09:30</small></div><div class="topic"><b>Acto inaugural</b><span>Palabras de la Sociedad Boliviana de Neurología, el Colegio Médico de Oruro y autoridades.</span></div></div>
        <div class="slot"><div class="time">09:30<small>—12:30</small></div><div class="topic"><b>Módulo: Enfermedad cerebrovascular en la altura</b><span>Epidemiología, fisiopatología del ictus en altitud y casos clínicos.</span></div></div>
        <div class="slot break"><div class="time">12:30<small>—14:00</small></div><div class="topic"><b>Receso · almuerzo</b></div></div>
        <div class="slot"><div class="time">14:00<small>—17:30</small></div><div class="topic"><b>Módulo: Actualización en Código Ictus</b><span>Activación del código, trombólisis, trombectomía y coordinación hospitalaria.</span></div></div>
      </div>
    </div>
    <div class="panel" id="d2">
      <div class="panel-head"><h3>Día 2 · Simposio + Seminario-Taller</h3><span class="ph-tag">Simposio + Taller</span></div>
      <div class="sched">
        <div class="slot"><div class="time">08:30<small>—12:30</small></div><div class="topic"><b>Módulo: Prevención primaria del ictus</b><span>Factores de riesgo, tamizaje, intervención temprana y educación comunitaria. <em>(Simposio Internacional)</em></span></div></div>
        <div class="slot break"><div class="time">12:30<small>—14:00</small></div><div class="topic"><b>Receso · almuerzo</b></div></div>
        <div class="slot"><div class="time">09:00<small>—17:00</small></div><div class="topic"><b>1er Seminario-Taller: Código Ictus y Manejo Hospitalario</b><span>Auditorio Hospital Gral. San Juan de Dios — Jornada intensiva de capacitación práctica en protocolo código ictus, manejo de vía aérea, escalas neurológicas y simulación de casos.</span></div></div>
        <div class="slot"><div class="time">14:00<small>—17:30</small></div><div class="topic"><b>Módulo: Atención de urgencias neurológicas</b><span>Status epiléptico, trauma y cuidado neurocrítico. <em>(Simposio Internacional)</em></span></div></div>
      </div>
    </div>
    <div class="panel" id="d3">
      <div class="panel-head"><h3>Día 3 · Cierre del Simposio</h3><span class="ph-tag sim">1er Simposio Internacional</span></div>
      <div class="sched">
        <div class="slot"><div class="time">09:00<small>—12:00</small></div><div class="topic"><b>Módulo: Socialización del Ictus</b><span>Feria de ictus — Gobernación de Oruro y Plaza principal "10 de Febrero".</span></div></div>
        <div class="slot"><div class="time">09:00<small>—11:30</small></div><div class="topic"><b>Ponentes internacionales invitados</b><span>Conferencias magistrales en modalidad virtual y presencial.</span></div></div>
        <div class="slot break"><div class="time">12:00<small>—14:00</small></div><div class="topic"><b>Receso · almuerzo</b></div></div>
        <div class="slot"><div class="time">14:00<small>—16:30</small></div><div class="topic"><b>Mesa redonda y conclusiones</b><span>Debate interdisciplinario y perspectivas en neurología de la altura.</span></div></div>
        <div class="slot"><div class="time">16:30<small>—17:30</small></div><div class="topic"><b>Entrega de certificados y clausura</b><span>Clausura oficial del Simposio Internacional.</span></div></div>
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
      <p>Precios en bolivianos (Bs). Precio especial para inscripciones hasta la primera semana de julio.</p>
    </div>

    <div class="cost-event-label">1er Simposio Internacional — Enfermedad Cerebrovascular en la Altura (23, 24 y 25 Julio)</div>
    <div class="cost-grid">
      <div class="cost-card pop">
        <span class="cost-tag">Especialistas</span>
        <h4>Especialidades</h4>
        <div class="cost-price"><small>Bs</small>350</div>
        <div class="cost-foot">Acceso a los 3 días + certificado</div>
      </div>
      <div class="cost-card">
        <h4>Médicos Generales</h4>
        <div class="cost-price"><small>Bs</small>200</div>
        <div class="cost-foot">Acceso a los 3 días</div>
      </div>
      <div class="cost-card">
        <h4>Lic. de Enfermería y Residentes</h4>
        <div class="cost-price"><small>Bs</small>150</div>
        <div class="cost-foot">Acceso a los 3 días</div>
      </div>
      <div class="cost-card">
        <h4>Aux. Enf. y Lic. Fisioterapia · Estudiantes</h4>
        <div class="cost-price"><small>Bs</small>100</div>
        <div class="cost-foot">Con credencial vigente</div>
      </div>
    </div>

    <div class="cost-event-label" style="margin-top:2.5rem">1er Seminario-Taller — Código Ictus y Manejo Hospitalario (24 Julio)</div>
    <div class="cost-grid">
      <div class="cost-card pop">
        <span class="cost-tag">Especialistas</span>
        <h4>Especialidades</h4>
        <div class="cost-price"><small>Bs</small>300</div>
        <div class="cost-foot">Acceso al taller + certificado</div>
      </div>
      <div class="cost-card">
        <h4>Médicos Generales</h4>
        <div class="cost-price"><small>Bs</small>200</div>
        <div class="cost-foot">Acceso al taller</div>
      </div>
      <div class="cost-card">
        <h4>Lic. de Enfermería</h4>
        <div class="cost-price"><small>Bs</small>200</div>
        <div class="cost-foot">Acceso al taller</div>
      </div>
      <div class="cost-card">
        <h4>Residentes · Aux. Enf. · Lic. Fisioterapia</h4>
        <div class="cost-price"><small>Bs</small>150</div>
        <div class="cost-foot">Acceso al taller</div>
      </div>
      <div class="cost-card">
        <h4>Estudiantes</h4>
        <div class="cost-price"><small>Bs</small>100</div>
        <div class="cost-foot">Precio especial hasta 1ra semana de julio</div>
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
        <h2>Inscríbete al Simposio y/o al Taller</h2>
        <p>Completa el formulario para reservar tu cupo. Luego realiza el depósito o transferencia y envía tu comprobante por WhatsApp para confirmar tu participación.</p>

        <div class="pay-box">
          <h4>💳 Modos de pago — Depósito o Transferencia</h4>
          <div class="pay-rows">
            <div class="pay-row"><span>Entidad</span><b>Banco Unión S.A.</b></div>
            <div class="pay-row"><span>N.º de cuenta</span><b class="acct">10000034276390</b></div>
            <div class="pay-row"><span>Titular</span><b>Raquel Madaín Prieto Ibarra</b></div>
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
              <label for="f-profession">Categoría profesional</label>
              <select id="f-profession" name="profession" required>
                <option value="" disabled selected>Selecciona…</option>
                <option value="Especialidad">Especialidad</option>
                <option value="Médico general">Médico general</option>
                <option value="Lic. de enfermería">Lic. de enfermería</option>
                <option value="Residente">Residente</option>
                <option value="Aux. Enfermería / Lic. Fisioterapia">Aux. Enfermería / Lic. Fisioterapia</option>
                <option value="Estudiante">Estudiante</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
            <div class="field">
              <label for="f-evento">Evento a inscribirse</label>
              <select id="f-evento" name="evento" required>
                <option value="" disabled selected>Selecciona…</option>
                <option value="Simposio Internacional (23-25 jul)">Simposio Internacional (23-25 jul)</option>
                <option value="Seminario-Taller Código Ictus (24 jul)">Seminario-Taller Código Ictus (24 jul)</option>
                <option value="Ambos eventos">Ambos eventos</option>
              </select>
            </div>
          </div>
          <div class="field-row">
            <div class="field">
              <label for="f-modalidad">Modalidad</label>
              <select id="f-modalidad" name="modalidad" required>
                <option value="" disabled selected>Selecciona…</option>
                <option value="Presencial — Oruro">Presencial — Oruro</option>
                <option value="Virtual — Online">Virtual — Online</option>
              </select>
            </div>
            <div class="field">
              <label for="f-ciudad">Ciudad / País</label>
              <input type="text" id="f-ciudad" name="ciudad" placeholder="Ej. Oruro, Bolivia" />
            </div>
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
      <div class="sp"><small>Farmedical</small>LS Saval</div>
      <div class="sp"><small>Laboratorio</small>FM Farmedical</div>
      <div class="sp"><small>Laboratorio</small>Megalabs</div>
      <div class="sp"><small>Pharma</small>Breskot Pharma</div>
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
          <div class="txt"><b>NeuroOruro 2026</b><span>Oruro · Bolivia · 2026</span></div>
        </a>
        <p>1er Simposio Internacional de Enfermedad Cerebrovascular en la Altura y 1er Seminario-Taller Código Ictus y Manejo Hospitalario. Oruro, Bolivia — julio 2026.</p>
      </div>
      <div class="foot-col">
        <h5>Informaciones</h5>
        <p class="foot-phones">Dra. Pamela Lopez · 72475801</p>
        <p class="foot-phones">Dra. Nineth Apaza · 60401730</p>
        <p class="foot-phones">Dra. Jheny Copa · 72557751</p>
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
      <span>© 2026 Sociedad Boliviana de Neurología · Colegio Médico de Oruro</span>
      <span>"El poder de tus brazos Oruro"</span>
    </div>
  </div>
</footer>

<!-- ===================== WHATSAPP FAB ===================== -->
<a href="https://wa.me/59172475801?text=Hola,%20quiero%20información%20sobre%20el%20Simposio%20Internacional%20NeuroOruro%202026"
   class="wa-fab" target="_blank" rel="noopener" aria-label="Informes por WhatsApp">
  <svg viewBox="0 0 24 24" fill="currentColor">
    <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.739-.981 0 .001zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
  </svg>
  <span class="wa-txt">Informes por WhatsApp</span>
</a>

@endsection

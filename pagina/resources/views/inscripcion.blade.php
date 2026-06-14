@extends('layouts.app')

@section('title', 'Inscripción — 1er Simposio Internacional NeuroOruro 2026')

@section('content')

<!-- NAV -->
<header class="nav scrolled" id="nav" style="position:relative;box-shadow:none;border-bottom:1px solid var(--line)">
  <div class="wrap nav-inner">
    <a href="/" class="brand">
      <div class="mark">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">
      </div>
      <div class="txt" style="color:inherit">
        <b style="color:var(--ink)">NeuroOruro 2026</b>
        <span style="color:var(--ink-soft)">¡Ciencia que conecta, salud que transforma!</span>
      </div>
    </a>
    <nav class="nav-links" id="navLinks" style="--link-c:var(--ink-soft)">
      <a href="/#eventos" style="color:var(--ink-soft)">Eventos</a>
      <a href="/#programa" style="color:var(--ink-soft)">Programa</a>
      <a href="/#costos" style="color:var(--ink-soft)">Costos</a>
      <a href="/inscripcion" style="color:var(--blue-500);font-weight:700">Inscripción</a>
      <a href="/#contacto" style="color:var(--ink-soft)">Contacto</a>
    </nav>
    <div class="nav-cta">
      <a href="/" class="btn btn-ghost" style="color:var(--ink);border-color:var(--line)">← Volver</a>
      <button class="menu-toggle" id="menuToggle" aria-label="Menú" style="--sp-c:var(--ink)"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>

<style>
.menu-toggle span{background:var(--sp-c,#fff)}
.reg-page{background:var(--bg);min-height:100vh;padding:40px 0 80px}
.reg-hero{background:linear-gradient(135deg,var(--navy-900),#2d000e);color:#fff;padding:40px 0 50px;position:relative;overflow:hidden}
.reg-hero::after{content:"";position:absolute;inset:0;background:radial-gradient(ellipse at 80% 50%,rgba(192,57,43,.35),transparent 60%);pointer-events:none}
.reg-hero .wrap{position:relative;z-index:1}
.reg-hero-inner{display:flex;align-items:center;gap:40px;flex-wrap:wrap}
.reg-hero-copy{flex:1;min-width:260px}
.reg-hero-copy .eyebrow{color:var(--cyan);margin-bottom:12px}
.reg-hero-copy .eyebrow::before{background:var(--cyan)}
.reg-hero-copy h1{font-size:clamp(1.5rem,3.5vw,2.4rem);font-weight:800;letter-spacing:-.025em;margin-bottom:12px}
.reg-hero-copy p{color:rgba(255,255,255,.78);font-size:.97rem;max-width:560px;line-height:1.65}
.reg-hero-badges{display:flex;gap:10px;flex-wrap:wrap;margin-top:20px}
.reg-hero-badges .pill{font-size:.76rem;padding:.4em .85em}
.reg-body{display:grid;grid-template-columns:1fr 360px;gap:28px;align-items:start;margin-top:32px}

/* Form card */
.reg-card{background:var(--white);border-radius:var(--radius);padding:32px 30px;box-shadow:var(--shadow-sm);border:1px solid var(--line)}
.reg-card h2{font-size:1.25rem;font-weight:800;margin-bottom:4px}
.reg-card .sub{color:var(--ink-soft);font-size:.88rem;margin-bottom:24px;line-height:1.55}
.reg-card .sub b{color:var(--blue-500)}
.fg{display:grid;gap:14px}
.fg-row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.fg-row.col3{grid-template-columns:1fr 1fr 1fr}
.fg-row.col1{grid-template-columns:1fr}
.fg .f{display:flex;flex-direction:column;gap:5px}
.fg .f label{font-size:.78rem;font-weight:700;color:var(--ink);font-family:var(--font-d);letter-spacing:.01em}
.fg .f label .req{color:var(--blue-500)}
.fg .f input,.fg .f select,.fg .f textarea{font-family:var(--font-b);font-size:.93rem;padding:.68em .9em;border:1.5px solid var(--line);
  border-radius:10px;background:var(--bg);color:var(--ink);transition:.2s;outline:none;width:100%}
.fg .f input:focus,.fg .f select:focus,.fg .f textarea:focus{border-color:var(--blue-500);background:#fff;box-shadow:0 0 0 3px rgba(192,57,43,.1)}
.fg .f.hidden{display:none}

/* Radio groups */
.radio-group{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:6px 14px;margin-top:2px}
.radio-group label{display:flex;align-items:center;gap:8px;font-size:.88rem;color:var(--ink);cursor:pointer;
  padding:.45em .7em;border-radius:8px;border:1.5px solid var(--line);background:var(--bg);transition:.18s;font-family:var(--font-b)}
.radio-group label:hover{border-color:var(--blue-400);background:var(--bg-tint)}
.radio-group input[type=radio]{accent-color:var(--blue-500);width:15px;height:15px;flex-shrink:0}
.radio-group input[type=radio]:checked + span{color:var(--blue-500);font-weight:600}
.radio-group label:has(input:checked){border-color:var(--blue-500);background:rgba(192,57,43,.06)}

.divider{height:1px;background:var(--line);margin:6px 0}
.section-label{font-family:var(--font-d);font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:var(--blue-500);display:flex;align-items:center;gap:8px}
.section-label::after{content:"";flex:1;height:1px;background:var(--line)}

/* File upload */
.file-drop{border:2px dashed var(--line);border-radius:12px;padding:22px;text-align:center;background:var(--bg);
  cursor:pointer;transition:.2s;position:relative;overflow:hidden}
.file-drop:hover,.file-drop.drag{border-color:var(--blue-500);background:rgba(192,57,43,.04)}
.file-drop input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
.file-drop .fd-icon{font-size:1.8rem;margin-bottom:6px}
.file-drop .fd-txt{font-size:.88rem;color:var(--ink-soft)}
.file-drop .fd-txt b{color:var(--blue-500)}
.file-preview{margin-top:12px;display:none;border-radius:10px;overflow:hidden;border:2px solid var(--blue-500);
  background:var(--bg);position:relative}
.file-preview img{width:100%;max-height:220px;object-fit:contain;display:block;background:#000}
.file-preview .fp-label{position:absolute;bottom:0;left:0;right:0;background:rgba(13,0,4,.7);color:#fff;
  font-size:.76rem;font-family:var(--font-d);padding:.4em .8em;display:flex;align-items:center;gap:6px}
.file-preview .fp-remove{margin-left:auto;cursor:pointer;opacity:.8;font-size:1rem;line-height:1}
.file-preview .fp-remove:hover{opacity:1}
.file-pdf{margin-top:12px;display:none;background:var(--bg-tint);border:2px solid var(--blue-500);border-radius:10px;
  padding:14px 16px;font-size:.88rem;color:var(--ink-soft);font-family:var(--font-d);align-items:center;gap:10px}
.file-pdf.show{display:flex}
.file-pdf .pdf-icon{font-size:1.6rem}

/* Submit */
.reg-submit{display:flex;flex-direction:column;gap:10px;margin-top:6px}
.reg-submit .btn{width:100%;justify-content:center;padding:1em;font-size:1rem}
.form-error{background:#fee2e2;color:#b91c1c;font-size:.86rem;padding:.7em 1em;border-radius:9px;font-family:var(--font-d);font-weight:600;display:none}

/* Success */
.form-success{display:none;text-align:left;padding:10px 0}
.form-success.show{display:block;animation:fade .4s ease}
.form-success .check-banner{background:linear-gradient(135deg,var(--navy-900),#2d000e);border-radius:14px;
  padding:24px;text-align:center;margin-bottom:20px}
.form-success .check-banner .check-ico{font-size:2.5rem;margin-bottom:8px}
.form-success .check-banner h3{font-size:1.35rem;font-weight:800;color:#fff;margin-bottom:4px}
.form-success .check-banner p{color:rgba(255,255,255,.75);font-size:.88rem}
.cred-box{background:var(--bg);border:1.5px solid var(--line);border-radius:12px;padding:16px 18px;margin-bottom:14px}
.cred-box h4{font-family:var(--font-d);font-size:.74rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--blue-500);margin-bottom:12px;display:flex;align-items:center;gap:6px}
.cred-row{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:10px;
  padding:.55em .8em;background:var(--white);border:1px solid var(--line);border-radius:8px}
.cred-row:last-child{margin-bottom:0}
.cred-row .cr-label{font-size:.74rem;color:var(--ink-soft);font-family:var(--font-d);font-weight:600;min-width:80px}
.cred-row .cr-val{font-family:var(--font-d);font-weight:700;color:var(--ink);font-size:.95rem;letter-spacing:.02em;flex:1}
.cred-row .cr-copy{background:none;border:1px solid var(--line);border-radius:6px;padding:.3em .6em;
  font-size:.72rem;font-family:var(--font-d);font-weight:600;color:var(--blue-500);cursor:pointer;transition:.18s;white-space:nowrap}
.cred-row .cr-copy:hover{background:var(--blue-500);color:#fff;border-color:var(--blue-500)}
.cred-row .cr-copy.copied{background:var(--blue-500);color:#fff;border-color:var(--blue-500)}
.cred-note{font-size:.8rem;color:var(--ink-soft);margin-bottom:16px;line-height:1.55;
  background:rgba(192,57,43,.06);border-left:3px solid var(--blue-500);padding:.6em .9em;border-radius:0 8px 8px 0}
.success-actions{display:flex;flex-direction:column;gap:10px}
.success-actions .btn{width:100%;justify-content:center}

/* Sidebar */
.reg-sidebar{display:flex;flex-direction:column;gap:18px}
.side-card{background:var(--white);border-radius:var(--radius);padding:22px 24px;box-shadow:var(--shadow-sm);border:1px solid var(--line)}
.side-card h4{font-family:var(--font-d);font-weight:800;font-size:.97rem;margin-bottom:14px;display:flex;align-items:center;gap:8px}
.pay-rows{display:flex;flex-direction:column;gap:10px}
.pay-row{display:flex;justify-content:space-between;gap:12px;font-size:.87rem;padding-bottom:10px;border-bottom:1px solid var(--line)}
.pay-row:last-child{border-bottom:0;padding-bottom:0}
.pay-row span{color:var(--ink-soft)}
.pay-row b{font-family:var(--font-d);color:var(--ink);text-align:right;font-size:.85rem}
.pay-row b.acct{letter-spacing:.04em;font-variant-numeric:tabular-nums;color:var(--blue-500)}

.cost-mini{display:flex;flex-direction:column;gap:7px}
.cost-mini-row{display:flex;justify-content:space-between;align-items:center;font-size:.85rem;
  padding:.45em .7em;border-radius:8px;background:var(--bg);border:1px solid var(--line)}
.cost-mini-row span{color:var(--ink-soft)}
.cost-mini-row b{font-family:var(--font-d);font-weight:700;color:var(--blue-500)}
.cost-mini-note{font-size:.76rem;color:var(--ink-soft);margin-top:4px;font-style:italic}

.contact-mini{display:flex;flex-direction:column;gap:8px}
.contact-mini a{display:flex;align-items:center;gap:10px;font-size:.87rem;color:var(--ink-soft);
  padding:.5em .7em;border-radius:8px;border:1px solid var(--line);background:var(--bg);transition:.18s}
.contact-mini a:hover{border-color:var(--blue-400);color:var(--blue-500)}
.contact-mini a .ci{font-size:1rem}
.contact-mini a div b{display:block;font-family:var(--font-d);color:var(--ink);font-size:.82rem}
.contact-mini a div span{font-size:.78rem}

@media(max-width:900px){
  .reg-body{grid-template-columns:1fr}
  .reg-sidebar{order:-1}
  .fg-row{grid-template-columns:1fr}
  .fg-row.col3{grid-template-columns:1fr 1fr}
}
@media(max-width:560px){
  .reg-card{padding:22px 18px}
  .fg-row.col3{grid-template-columns:1fr}
  .radio-group{grid-template-columns:1fr 1fr}
}
</style>

<!-- Hero del formulario -->
<div class="reg-hero">
  <div class="wrap">
    <div class="reg-hero-inner">
      <div class="reg-hero-copy">
        <span class="eyebrow">Inscripción oficial</span>
        <h1>1er Simposio Internacional<br>Enfermedad Cerebrovascular en la Altura</h1>
        <p>En el siguiente formulario se recabará toda la información principal para su inscripción y posterior certificación en la finalización del simposio. <strong>Por favor llene el NOMBRE COMPLETO Y LA PROFESIÓN de forma correcta.</strong></p>
        <div class="reg-hero-badges">
          <span class="pill"><span class="dot"></span> 23, 24 y 25 Julio 2026</span>
          <span class="pill"><span class="dot"></span> Oruro, Bolivia</span>
          <span class="pill accent"><span class="dot"></span> Modalidad Híbrida</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="reg-page">
  <div class="wrap">
    <div class="reg-body">

      <!-- FORMULARIO -->
      <div class="reg-card">
        <h2>Formulario de inscripción</h2>
        <p class="sub">Los campos marcados con <b>*</b> son obligatorios. Adjunte su comprobante de pago al finalizar.</p>

        <form id="regForm" novalidate enctype="multipart/form-data">
          @csrf
          <div class="fg">

            <div class="section-label">Datos personales</div>

            <div class="fg-row">
              <div class="f">
                <label>Primer Apellido <span class="req">*</span></label>
                <input type="text" name="firstSurname" placeholder="Ej. Mamani" required>
              </div>
              <div class="f">
                <label>Segundo Apellido</label>
                <input type="text" name="secondSurname" placeholder="Ej. Quispe">
              </div>
            </div>

            <div class="fg-row">
              <div class="f">
                <label>Primer Nombre <span class="req">*</span></label>
                <input type="text" name="firstName" placeholder="Ej. Ana" required>
              </div>
              <div class="f">
                <label>Segundo Nombre</label>
                <input type="text" name="secondName" placeholder="Ej. María">
              </div>
            </div>

            <div class="fg-row">
              <div class="f">
                <label>N° de Carnet de Identidad <span class="req">*</span></label>
                <input type="text" name="ci" placeholder="Ej. 1234567" required>
              </div>
              <div class="f">
                <label>N° de Celular <span class="req">*</span></label>
                <input type="tel" name="phone" placeholder="Ej. 70000000" required>
              </div>
            </div>

            <div class="fg-row col1">
              <div class="f">
                <label>Correo Electrónico</label>
                <input type="email" name="email" placeholder="tu@correo.com">
              </div>
            </div>

            <div class="divider"></div>
            <div class="section-label">Profesión <span class="req" style="font-size:.9em;letter-spacing:0">*</span></div>

            <div class="f">
              <div class="radio-group" id="professionGroup">
                @foreach(['Médico General','Especialista','Residente','Lic. en Enfermería','Aux. en Enfermería','Lic. en Fisioterapia','Lic. en Fisioterapia y Kinesiología','Estudiante','Otro'] as $p)
                <label>
                  <input type="radio" name="profession" value="{{ $p }}" {{ $p==='Otro' ? 'data-other' : '' }} required>
                  <span>{{ $p }}</span>
                </label>
                @endforeach
              </div>
            </div>
            <div class="f hidden" id="professionOtherWrap">
              <label>Especifique su profesión</label>
              <input type="text" name="professionOther" id="professionOther" placeholder="Escribe tu profesión">
            </div>

            <div class="divider"></div>
            <div class="section-label">Ubicación</div>

            <div class="fg-row col1">
              <div class="f">
                <label>Departamento <span class="req">*</span></label>
                <select name="departamento" required>
                  <option value="" disabled selected>Selecciona…</option>
                  @foreach(['Oruro','La Paz','Potosí','Cochabamba','Chuquisaca','Tarija','Pando','Beni','Santa Cruz','Otro'] as $d)
                    <option value="{{ $d }}">{{ $d }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="f hidden" id="departamentoOtherWrap">
              <label>Especifique departamento/país</label>
              <input type="text" name="departamentoOther" placeholder="Ej. Extranjero — Argentina">
            </div>

            <div class="fg-row">
              <div class="f">
                <label>Provincia / Municipio / Región</label>
                <input type="text" name="provincia" placeholder="Ej. Cercado">
              </div>
              <div class="f">
                <label>Dirección</label>
                <input type="text" name="direccion" placeholder="Calle, N°, Barrio">
              </div>
            </div>

            <div class="divider"></div>
            <div class="section-label">Evento y modalidad</div>

            <div class="fg-row">
              <div class="f">
                <label>Evento a inscribirse</label>
                <select name="cursoTaller">
                  <option value="Simposio Internacional (23-25 jul)">Simposio Internacional (23-25 jul)</option>
                  <option value="Seminario-Taller Código Ictus (24 jul)">Seminario-Taller Código Ictus (24 jul)</option>
                  <option value="Ambos eventos">Ambos eventos</option>
                </select>
              </div>
              <div class="f">
                <label>Modalidad</label>
                <select name="modalidad">
                  <option value="Presencial">Presencial — Oruro</option>
                  <option value="Virtual">Virtual — Online</option>
                </select>
              </div>
            </div>

            <div class="divider"></div>
            <div class="section-label">Comprobante de pago <span class="req" style="font-size:.9em;letter-spacing:0">*</span></div>

            <div class="f">
              <div class="file-drop" id="fileDrop">
                <input type="file" name="file" id="fileInput" accept=".jpg,.jpeg,.png,.pdf" required>
                <div class="fd-icon">📎</div>
                <div class="fd-txt">Arrastra tu comprobante aquí o <b>haz clic para seleccionar</b></div>
                <div class="fd-txt" style="font-size:.76rem;margin-top:4px">JPG, PNG o PDF · máx. 10 MB</div>
              </div>
              <div class="file-preview" id="filePreview">
                <img id="previewImg" src="" alt="Vista previa del comprobante">
                <div class="fp-label">
                  <span id="previewName"></span>
                  <span class="fp-remove" id="removeFile" title="Quitar archivo">✕</span>
                </div>
              </div>
              <div class="file-pdf" id="filePdfInfo">
                <span class="pdf-icon">📄</span>
                <span id="pdfName"></span>
              </div>
            </div>

            <div class="form-error" id="form-error"></div>

            <div class="reg-submit">
              <button type="submit" class="btn btn-primary" id="submitBtn">Enviar inscripción →</button>
            </div>

          </div>
        </form>

        <div class="form-success" id="formSuccess">
          <div class="check-banner">
            <div class="check-ico">✅</div>
            <h3>¡Inscripción registrada!</h3>
            <p id="successMsg">Tu inscripción quedó registrada correctamente.</p>
          </div>

          <div class="cred-box">
            <h4>🔑 Guarda tus credenciales de acceso</h4>
            <div class="cred-row">
              <span class="cr-label">Usuario</span>
              <span class="cr-val" id="credNickname">—</span>
              <button class="cr-copy" data-target="credNickname">Copiar</button>
            </div>
            <div class="cred-row">
              <span class="cr-label">Contraseña</span>
              <span class="cr-val" id="credPassword">—</span>
              <button class="cr-copy" data-target="credPassword">Copiar</button>
            </div>
          </div>

          <p class="cred-note">
            ⚠ <strong>Por favor guarda estas credenciales.</strong> Tu contraseña inicial es tu número de carnet de identidad. Podrás usarlas para acceder al sistema y descargar tu certificado al finalizar el simposio.
          </p>

          <div class="success-actions">
            <a href="#" id="successWa" class="btn btn-primary" target="_blank" rel="noopener">
              Confirmar inscripción por WhatsApp →
            </a>
            <a href="/" class="btn btn-ghost" style="color:var(--ink);border-color:var(--line);background:var(--bg)">
              Volver al inicio
            </a>
          </div>
        </div>
      </div>

      <!-- SIDEBAR -->
      <aside class="reg-sidebar">

        <div class="side-card">
          <h4>💳 Datos de pago</h4>
          <div class="pay-rows">
            <div class="pay-row"><span>Banco</span><b>Banco Unión S.A.</b></div>
            <div class="pay-row"><span>Cuenta</span><b class="acct">10000034276390</b></div>
            <div class="pay-row"><span>Titular</span><b>Raquel Madaín Prieto Ibarra</b></div>
            <div class="pay-row"><span>Tipo</span><b>Depósito o Transferencia</b></div>
          </div>
        </div>

        <div class="side-card">
          <h4>💰 Costos — Simposio</h4>
          <div class="cost-mini">
            <div class="cost-mini-row"><span>Especialistas</span><b>Bs 350</b></div>
            <div class="cost-mini-row"><span>Médicos Generales</span><b>Bs 200</b></div>
            <div class="cost-mini-row"><span>Lic. Enfermería / Residentes</span><b>Bs 150</b></div>
            <div class="cost-mini-row"><span>Aux. Enf. / Lic. Fisioterapia</span><b>Bs 100</b></div>
            <div class="cost-mini-row"><span>Estudiantes</span><b>Bs 100</b></div>
            <p class="cost-mini-note">Precio especial hasta la 1ra semana de julio.</p>
          </div>
        </div>

        <div class="side-card">
          <h4>💰 Costos — Taller</h4>
          <div class="cost-mini">
            <div class="cost-mini-row"><span>Especialistas</span><b>Bs 300</b></div>
            <div class="cost-mini-row"><span>Médicos / Lic. Enfermería</span><b>Bs 200</b></div>
            <div class="cost-mini-row"><span>Residentes / Aux. / Fisio</span><b>Bs 150</b></div>
            <div class="cost-mini-row"><span>Estudiantes</span><b>Bs 100</b></div>
          </div>
        </div>

        <div class="side-card">
          <h4>📞 Informaciones</h4>
          <div class="contact-mini">
            <a href="https://wa.me/59172475801" target="_blank" rel="noopener">
              <span class="ci">💬</span>
              <div><b>Dra. Pamela Lopez</b><span>72475801</span></div>
            </a>
            <a href="https://wa.me/59160401730" target="_blank" rel="noopener">
              <span class="ci">💬</span>
              <div><b>Dra. Nineth Apaza</b><span>60401730</span></div>
            </a>
            <a href="https://wa.me/59172557751" target="_blank" rel="noopener">
              <span class="ci">💬</span>
              <div><b>Dra. Jheny Copa</b><span>72557751</span></div>
            </a>
          </div>
        </div>

      </aside>
    </div>
  </div>
</div>

<!-- WHATSAPP FAB -->
<a href="https://wa.me/59172475801?text=Hola,%20quiero%20información%20sobre%20NeuroOruro%202026"
   class="wa-fab" target="_blank" rel="noopener" aria-label="Informes por WhatsApp">
  <svg viewBox="0 0 24 24" fill="currentColor">
    <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.51 5.26l-.999 3.648 3.739-.981 0 .001zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
  </svg>
  <span class="wa-txt">Informes por WhatsApp</span>
</a>

<script>
/* Profession "Otro" toggle */
document.querySelectorAll('input[name="profession"]').forEach(r => {
  r.addEventListener('change', () => {
    const wrap = document.getElementById('professionOtherWrap');
    const input = document.getElementById('professionOther');
    if (r.value === 'Otro' && r.checked) {
      wrap.classList.remove('hidden');
      input.required = true;
    } else {
      wrap.classList.add('hidden');
      input.required = false;
    }
  });
});

/* Departamento "Otro" toggle */
document.querySelector('select[name="departamento"]').addEventListener('change', function() {
  const wrap = document.getElementById('departamentoOtherWrap');
  wrap.classList.toggle('hidden', this.value !== 'Otro');
});

/* File preview */
const fileInput  = document.getElementById('fileInput');
const fileDrop   = document.getElementById('fileDrop');
const filePreview = document.getElementById('filePreview');
const previewImg = document.getElementById('previewImg');
const previewName = document.getElementById('previewName');
const removeFile = document.getElementById('removeFile');
const filePdfInfo = document.getElementById('filePdfInfo');
const pdfName    = document.getElementById('pdfName');

function clearPreview() {
  filePreview.style.display = 'none';
  filePdfInfo.classList.remove('show');
  previewImg.src = '';
  fileInput.value = '';
}

fileInput.addEventListener('change', () => {
  const file = fileInput.files[0];
  if (!file) return;
  if (file.type === 'application/pdf') {
    filePreview.style.display = 'none';
    pdfName.textContent = file.name;
    filePdfInfo.classList.add('show');
  } else {
    filePdfInfo.classList.remove('show');
    const reader = new FileReader();
    reader.onload = e => {
      previewImg.src = e.target.result;
      previewName.textContent = file.name;
      filePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  }
});

removeFile.addEventListener('click', (e) => { e.stopPropagation(); clearPreview(); });

['dragenter','dragover'].forEach(ev => fileDrop.addEventListener(ev, e => { e.preventDefault(); fileDrop.classList.add('drag'); }));
['dragleave','drop'].forEach(ev => fileDrop.addEventListener(ev, e => { e.preventDefault(); fileDrop.classList.remove('drag'); }));

/* Copy credentials */
document.querySelectorAll('.cr-copy').forEach(btn => {
  btn.addEventListener('click', () => {
    const val = document.getElementById(btn.dataset.target)?.textContent ?? '';
    navigator.clipboard.writeText(val).then(() => {
      btn.textContent = '✓ Copiado';
      btn.classList.add('copied');
      setTimeout(() => { btn.textContent = 'Copiar'; btn.classList.remove('copied'); }, 2000);
    });
  });
});

/* Form submit */
const regForm     = document.getElementById('regForm');
const formSuccess = document.getElementById('formSuccess');
const successMsg  = document.getElementById('successMsg');
const successWa   = document.getElementById('successWa');
const formError   = document.getElementById('form-error');
const submitBtn   = document.getElementById('submitBtn');

regForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  if (!regForm.checkValidity()) { regForm.reportValidity(); return; }

  submitBtn.disabled = true;
  submitBtn.textContent = 'Enviando…';
  formError.style.display = 'none';

  try {
    const formData = new FormData(regForm);
    const res = await fetch('/inscripcion', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json',
      },
      body: formData,
    });

    const data = await res.json();

    if (!res.ok) {
      const msgs = data.errors
        ? Object.values(data.errors).flat().join(' · ')
        : (data.message || 'Error al enviar.');
      formError.textContent = msgs;
      formError.style.display = 'block';
      submitBtn.disabled = false;
      submitBtn.textContent = 'Enviar inscripción →';
      return;
    }

    /* Mostrar credenciales */
    document.getElementById('credNickname').textContent = data.nickname;
    document.getElementById('credPassword').textContent = data.password;
    successMsg.textContent = `¡Gracias, ${data.nombre}! Tu inscripción como ${data.category} quedó registrada correctamente.`;
    successWa.href = data.wa_url;
    regForm.style.display = 'none';
    formSuccess.classList.add('show');
    formSuccess.scrollIntoView({ behavior: 'smooth', block: 'start' });

  } catch {
    formError.textContent = 'Error de conexión. Intenta nuevamente.';
    formError.style.display = 'block';
    submitBtn.disabled = false;
    submitBtn.textContent = 'Enviar inscripción →';
  }
});
</script>

@endsection

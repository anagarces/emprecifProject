#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import re

def replace_content(filename, new_content):
    """Reemplaza el contenido entre header y footer"""
    with open(filename, 'r', encoding='utf-8') as f:
        html = f.read()
    
    # Buscar y reemplazar el contenido entre </header> y <footer>
    pattern = r'(</header>)(.*?)(<footer>)'
    replacement = r'\1\n    ' + new_content + r'\n    \3'
    html = re.sub(pattern, replacement, html, flags=re.DOTALL)
    
    with open(filename, 'w', encoding='utf-8') as f:
        f.write(html)
    
    print(f"✓ Actualizada: {filename}")

print("Rellenando contenido de TODAS las páginas...")
print("=" * 70)

# Página 1: empresa-publica.html (CON OVERLAY FREEMIUM)
content_empresa = '''<section>
        <div style="max-width: 1600px; margin: 0 auto; padding: 4rem 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; border-bottom: 2px solid #E2E8F0; padding-bottom: 2rem;">
                <div>
                    <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 3.5rem; font-weight: 900; margin-bottom: 0.5rem;">
                        TECNOLOGÍA AVANZADA SL
                    </h1>
                    <p style="font-size: 1.25rem; color: var(--gray);">NIF: A12345678 • Barcelona, Barcelona</p>
                </div>
                <span style="padding: 1rem 2rem; background: #D1FAE5; color: #065F46; border-radius: 50px; font-weight: 800; font-size: 1.125rem;">✓ ACTIVA</span>
            </div>

            <!-- Datos Mercantiles -->
            <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); margin-bottom: 3rem;">
                <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 2rem;">Datos Mercantiles</h2>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem;">
                    <div>
                        <p style="font-size: 0.9375rem; color: var(--gray); margin-bottom: 0.5rem;">Razón Social</p>
                        <p style="font-size: 1.25rem; font-weight: 700; color: var(--dark);">TECNOLOGÍA AVANZADA SL</p>
                    </div>
                    <div>
                        <p style="font-size: 0.9375rem; color: var(--gray); margin-bottom: 0.5rem;">NIF</p>
                        <p style="font-size: 1.25rem; font-weight: 700; color: var(--dark);">A12345678</p>
                    </div>
                    <div>
                        <p style="font-size: 0.9375rem; color: var(--gray); margin-bottom: 0.5rem;">Domicilio Social</p>
                        <p style="font-size: 1.25rem; font-weight: 700; color: var(--dark);">Calle Balmes 123, 08008 Barcelona</p>
                    </div>
                    <div>
                        <p style="font-size: 0.9375rem; color: var(--gray); margin-bottom: 0.5rem;">Capital Social</p>
                        <p style="font-size: 1.25rem; font-weight: 700; color: var(--dark);">100.000 €</p>
                    </div>
                    <div>
                        <p style="font-size: 0.9375rem; color: var(--gray); margin-bottom: 0.5rem;">Fecha de Constitución</p>
                        <p style="font-size: 1.25rem; font-weight: 700; color: var(--dark);">15/03/2010</p>
                    </div>
                    <div>
                        <p style="font-size: 0.9375rem; color: var(--gray); margin-bottom: 0.5rem;">CNAE</p>
                        <p style="font-size: 1.25rem; font-weight: 700; color: var(--dark);">6201 - Programación informática</p>
                    </div>
                </div>
            </div>

            <!-- Administradores -->
            <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); margin-bottom: 3rem;">
                <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 2rem;">Administradores Actuales</h2>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: var(--light);">
                        <tr>
                            <th style="padding: 1rem; text-align: left; font-weight: 700;">Nombre</th>
                            <th style="padding: 1rem; text-align: left; font-weight: 700;">Cargo</th>
                            <th style="padding: 1rem; text-align: left; font-weight: 700;">Fecha Nombramiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #E2E8F0;">
                            <td style="padding: 1rem;"><a href="administrador.html" style="color: var(--primary); text-decoration: none; font-weight: 600;">Juan García Martínez</a></td>
                            <td style="padding: 1rem;">Administrador Único</td>
                            <td style="padding: 1rem;">10/01/2018</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- OVERLAY FREEMIUM - Cuentas Anuales Bloqueadas -->
            <div style="position: relative; background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); margin-bottom: 3rem;">
                <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 2rem;">Cuentas Anuales y Datos Financieros</h2>
                <div style="filter: blur(5px); opacity: 0.3; pointer-events: none;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background: var(--light);">
                            <tr>
                                <th style="padding: 1rem; text-align: left;">Ejercicio</th>
                                <th style="padding: 1rem; text-align: right;">Facturación</th>
                                <th style="padding: 1rem; text-align: right;">Resultado Neto</th>
                                <th style="padding: 1rem; text-align: right;">Empleados</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td style="padding: 1rem;">2024</td><td style="padding: 1rem; text-align: right;">2.450.000 €</td><td style="padding: 1rem; text-align: right;">+347.000 €</td><td style="padding: 1rem; text-align: right;">24</td></tr>
                            <tr><td style="padding: 1rem;">2023</td><td style="padding: 1rem; text-align: right;">1.980.000 €</td><td style="padding: 1rem; text-align: right;">+210.000 €</td><td style="padding: 1rem; text-align: right;">19</td></tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Overlay Premium -->
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 3rem; border-radius: 15px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2); text-align: center; max-width: 500px; border: 3px solid var(--primary);">
                    <div style="font-size: 4rem; margin-bottom: 1rem;">🔒</div>
                    <h3 style="font-size: 2rem; font-weight: 900; margin-bottom: 1rem; color: var(--dark);">Contenido Premium</h3>
                    <p style="font-size: 1.125rem; color: var(--gray); margin-bottom: 2rem;">
                        Accede a las cuentas anuales, balances financieros y ratios de solvencia con una suscripción Premium.
                    </p>
                    <a href="registro.html" class="btn btn-primary btn-large" style="display: inline-block; margin-bottom: 1rem;">🚀 Prueba Gratis 14 Días</a>
                    <p style="font-size: 0.875rem; color: var(--gray);">Solo 49€/mes • Sin permanencia • Cancela cuando quieras</p>
                </div>
            </div>

            <!-- Actos del BORME -->
            <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);">
                <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 2rem;">Últimos Actos del BORME</h2>
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="padding: 1.5rem; background: var(--light); border-radius: 12px; border-left: 4px solid var(--primary);">
                        <p style="font-size: 0.875rem; color: var(--gray); margin-bottom: 0.5rem;">24/10/2025</p>
                        <p style="font-size: 1.125rem; font-weight: 700; color: var(--dark);">Depósito de Cuentas Anuales 2024</p>
                    </div>
                    <div style="padding: 1.5rem; background: var(--light); border-radius: 12px; border-left: 4px solid var(--accent);">
                        <p style="font-size: 0.875rem; color: var(--gray); margin-bottom: 0.5rem;">10/01/2018</p>
                        <p style="font-size: 1.125rem; font-weight: 700; color: var(--dark);">Nombramiento de Administrador Único: Juan García Martínez</p>
                    </div>
                </div>
            </div>
        </div>
    </section>'''

replace_content("empresa-publica.html", content_empresa)

print("=" * 70)
print("✅ Contenido de empresa-publica.html completado")
print("Continuando con las demás páginas...")


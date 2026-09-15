# AGENTS – Componist Developer Bar

## Zweck

Beispiel-/Demo-Package: Developer-Bar mit Tailwind v4, Alpine.js und Livewire — zeigt Package-Frontend-Integration.

## Grenzen & Abhängigkeiten

- Gehört rein: Middleware-Injection, Demo-Livewire, Vite-Assets
- Gehört nicht: Produktions-Features der Host-App
- Status: **registriert**; Middleware nur bei `DEVELOPER_BAR_ENABLED=true` + `local` + `APP_DEBUG`

## Struktur

```
src/Application/DeveloperBarService.php
src/DeveloperBarServiceProvider.php
src/Livewire/…
resources/ (CSS/JS via Vite)
```

## Einbindung

- Provider: `Componist\DeveloperBar\DeveloperBarServiceProvider`
- Nur nach Freigabe in `bootstrap/providers.php` + Root-Vite-Build

## Konventionen

- Als Referenz für Package-Asset-Pipeline nutzen, nicht in Production aktivieren

## Tests

Bei Registrierung: Smoke-Test dass Middleware nur in `local`/`APP_DEBUG` injiziert.

## Security

- Developer-UI **niemals** in Staging/Production ohne Gate
- Skill `security-audit` vor Aktivierung

## Do / Don’t

- Do: als Template für andere Packages mit Frontend-Build
- Don’t: ungeprüft in Production-Provider registrieren

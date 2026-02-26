# Symfony Outfit & CompanyEnrich Demo

Dieses Projekt ist ein kleines Symfony-Webprojekt, das zeigt:

- Integration der **CompanyEnrich API** (Firmen- und Personensuche)
- Zwei Buttons im Webinterface:
    - 🔎 **Firma suchen**
    - 👥 **Personen suchen**
- Input-Feld für Domains oder Firmennamen
- **DDEV-ready** Setup für lokale Entwicklung

---

## Voraussetzungen

- PHP 8.2 oder höher
- Composer
- DDEV (lokale Entwicklungsumgebung)
- Symfony CLI (optional, für lokale Serverstarts)

---

## Installation

1. Repository klonen:

```bash
git clone <repo-url>
cd <projektordner>
```

2. DDEV-Setup:

```bash
ddev config --project-type=symfony --docroot=public
ddev start
```
3. Composer-Abhängigkeiten installieren

```bash
ddev composer install
```
4. ApiToken setzen
```bash
# in .env.local`
COMPANY_ENRICH_TOKEN=dein-token
```

## Nutzung

Webinterface öffnen

```bash
ddev launch
```

Projektstruktur

```bash
src/
 ├── Controller/
 │    └── ApiController.php
 ├── Service/
 │    └── ApiClientEnrich.php
templates/
 └── api/index.html.twig
```

- **Controller**: Verarbeitet die Eingaben vom Formular und ruft die Services auf
- **Service**: Enthält die Logik für die API-Anfragen (CompanySearch, PeopleSearch)
- **Template**: Twig-Template für Input-Feld, Buttons und Anzeige der Ergebnisse

---

## Lizenz

Dieses Projekt steht unter MIT-Lizenz.

---

## Contribution

1. Repository forken
2. Branch erstellen (`feature/meine-aenderung`)
3. Änderungen pushen
4. Pull Request öffnen

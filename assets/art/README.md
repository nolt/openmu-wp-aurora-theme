# OpenMU Aurora - artwork

All artwork in this folder is original to the OpenMU Aurora theme. It contains nothing taken from the MU
game client or from Webzen (no logos, textures, models or screenshots) and no third-party stock images.
The theme release ships no game client files at all.

Licence: GPL-2.0-or-later, copyright (c) Nolt.

## How the painted images were made

- Generator: Stable Diffusion 1.5 fine-tune **DreamShaper 8** (`Lykon/dreamshaper-8`), licence CreativeML OpenRAIL-M
  (generated outputs may be used, also commercially), run with `diffusers` on a GTX 1650 (fp32, block offload).
- Upscaler: **Real-ESRGAN x4plus** (BSD-3-Clause) through `spandrel`.
- Background removal: **BiRefNet** through `rembg` (MIT) for the characters and the far peaks / citadel;
  the near cliffs are keyed with a script (`cliffkey.py`: flood fill against a fitted sky gradient) because the
  neural cut-out only found the rocks.
- Inpainting (`gen.py inpaint`, used for the elf's bow) uses `Lykon/dreamshaper-8-inpainting` (CreativeML OpenRAIL-M).
- Prompts describe generic fantasy archetypes only: no game names, no artist names.
- Reproducibility: the full settings (prompt, negative prompt, seed, steps, cfg, size, model) of every used
  generated image are kept in the development repository (`tools/gen/prompts/<name>.json`, with the batch
  scripts and the post-processing: mirroring, keying, assembling WebP); they are not part of the theme release.
- Final step (`assemble.py`): alpha clean-up (matte shrunk by ~2 px against halos), uniform sizing, WebP export.

## Files

| File | Size | What / how |
|---|---|---|
| `characters/dark-knight.webp` | 1000x1300, alpha | Heavy plate armour, greatsword. Candidate `bk-100`; the upper body (helmet, torso, pauldrons, upper arms) was made exactly symmetric by mirroring one half, then re-painted with img2img at strength 0.3 (`bk4-131`, prompt `prompts/dark-knight.json`). |
| `characters/dark-wizard.webp` | 1000x1300, alpha | Hooded robed mage, crystal staff. txt2img seed 200 (`sm-200`, `prompts/dark-wizard.json`), 3/4 pose. |
| `characters/fairy-elf.webp` | 1000x1300, alpha | Light silver/green armour, long hair. txt2img seed 302 (`me-302`, `prompts/fairy-elf.json`); the original bow was a bent stick, so the stick and old bow were erased, a plain sketch of a recurve bow was drawn and repainted by inpainting (`Lykon/dreamshaper-8-inpainting`, strength 0.8, seed 903, `prompts/fairy-elf-bow.json`, `batches/elf-bow.sh`, `postprocess/elfinit.py`, `elfclean.py`). |
| `characters/dark-lord.webp` | 1000x1300, alpha | Dark ornate armour, cape, crown-like circlet, crystal sceptre. txt2img seed 1003 (`dl-1003`, `batches/chars2.sh`). |
| `characters/magic-gladiator.webp` | 1000x1300, alpha | Light/medium armour, one-handed sword with a violet glow. txt2img seed 1101 (`mg-1101`). |
| `characters/summoner.webp` | 1000x1300, alpha | Teal robes, spellbook and staff with a sigil crystal. txt2img seed 1203 (`su-1203`). |
| `characters/rage-fighter.webp` | 1000x1300, alpha | Unarmed male fighter, armoured gauntlets, fighting stance. txt2img seed 1401 (`rfm-1401`, `batches/chars3.sh`; the first, female take `rf-1303` was dropped). |
| `scene/sky.webp` | 2560x1440 | Aurora night sky, `sky-401` cropped above its horizon, upscaled x4 and stretched to 16:9 (no horizon objects). |
| `scene/peaks-far.webp` | 2560x1009, alpha | Snowy peaks (`peaks-500`), cut out, tinted with blue haze; two tiles (second one mirrored and enlarged, feathered join). |
| `scene/citadel.webp` | 2560x1250, alpha | Moonlit castle (`citadel-600`), cut out, positioned right of centre in an empty canvas. |
| `scene/cliffs-near.webp` | 2560x942, alpha | Rocks and snowy pines (`cliffs-700`), sky keyed out, same two-tile fill as the peaks. |
| `scene/mist.webp` | 2560x647, alpha | Fog (`mist-801`), luminance turned into alpha, tinted ice blue. |
| `scene/hero-poster.webp` | 1920x1080 | Static fallback: the five layers flattened (stage 2560x1440, scaled down). |
| `news/fallback-1..4.webp` | 1200x675 | Castle bridge (`a-900`), ice castle lake (`b-911`), lantern forest (`c-920`), lighthouse (`d-930`). |
| `banners/download.webp`, `banners/community.webp` | 1920x600 | Valley with aurora (`dl-940`), violet castle on a hill (`co-951`). |
| `logo/emblem.svg`, `logo/favicon.svg` | vector | Hand-written: aurora crystal with a mirrored wing pair. |
| `icons/*.svg` | 24x24 | 22 hand-written line icons, `stroke="currentColor"`, width 1.75, round caps. |
| `ornaments/divider.svg`, `ornaments/frame-corner.svg` | vector | Hand-written thin silver/aurora hairline ornaments (corner is top-left; flip it in CSS). |

## Using the scene layers

All scene layers are 2560 px wide. Stack bottom-aligned at `width: 100%` in this order: `sky` (use as a
cover background, 16:9), `peaks-far`, `citadel`, `cliffs-near`, `mist`. Layers have different heights on purpose.
The seven characters (`postprocess/chars7.py`) share the canvas size, the height of the figure (1290 px) and the ground line (bottom edge).

## Known limitations

AI-painted: the knight's armour is symmetric by construction, but the other heroes are natural 3/4 / contrapposto
poses, so paired parts there are similar, not mirror-identical. The elf's bow is held upright with a thin bowstring and its fingers are partly hidden behind the grip; the Rage Fighter has a narrow, upright figure. The citadel sits on a peak rather than floating
freely. The mage's sandals carry tiny glyph-like ornaments.

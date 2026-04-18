# Design System Specification: Kinetic Editorial

## 1. Overview & Creative North Star
This design system is built to transcend the "utility-first" look of standard educational platforms. For an FSL (Filipino Sign Language) platform, movement and clarity are the primary languages. We are moving away from the "Admin Dashboard" aesthetic toward a **"Kinetic Editorial"** experience.

**Creative North Star: The Fluid Classroom**
Imagine a high-end fashion magazine crossed with a responsive fluid simulation. The UI does not sit flat on the screen; it breathes. We utilize intentional asymmetry, overlapping elements, and high-contrast typography to guide the learner's eye through the curriculum. This system prioritizes the "human" element of signing through soft textures and organic transitions, ensuring the digital interface never feels colder than the human hands it teaches.

---

## 2. Color Strategy
Our palette centers on deep, authoritative teals (`primary`) balanced by vibrant, life-affirming greens and ambers (`secondary` and `tertiary`) that signal progress and achievement.

### The "No-Line" Rule
**Explicit Instruction:** All designers are prohibited from using 1px solid borders to define sections or containers. 
Structure must be achieved through:
*   **Tonal Shifts:** Placing a `surface_container_low` card on a `surface` background.
*   **Shadow Depth:** Using ambient shadows to lift elements.
*   **Negative Space:** Using our spacing scale to create "invisible boundaries."

### Surface Hierarchy & Nesting
Treat the UI as a physical stack of premium materials.
*   **Background (`#f6f6ff`):** The base canvas.
*   **Surface Containers:** Use `surface_container_lowest` for the most prominent interactive cards to make them "pop" against the darker background tiers.
*   **The Glass & Gradient Rule:** For floating video players or modal overlays, use `surface_tint` at 10% opacity with a `backdrop-filter: blur(20px)`. Main CTAs should utilize a subtle linear gradient from `primary` (#00647d) to `primary_dim` (#00576d) to create a sense of tactile curvature.

---

## 3. Typography
We use a dual-font system to balance editorial personality with pedagogical clarity.

*   **Display & Headlines (Plus Jakarta Sans):** Chosen for its modern, geometric flair. 
    *   *Usage:* Headlines (`headline-lg`) should have a slightly tight letter-spacing (-0.02em) to feel "designed" and authoritative.
*   **Body & Titles (Manrope):** A highly functional sans-serif that remains legible even at small sizes.
    *   *Usage:* All instructional text must use `body-lg` or `body-md` to ensure the learner is never fatigued.

| Level | Token | Font | Size | Weight |
| :--- | :--- | :--- | :--- | :--- |
| **Hero Title** | `display-lg` | Plus Jakarta Sans | 3.5rem | 700 |
| **Section Head** | `headline-md` | Plus Jakarta Sans | 1.75rem | 600 |
| **Subheading** | `title-lg` | Manrope | 1.375rem | 500 |
| **Instructional** | `body-lg` | Manrope | 1.0rem | 400 |

---

## 4. Elevation & Depth
Depth in this system is a tool for focus, not just decoration.

*   **The Layering Principle:** Avoid shadows where background color shifts can do the work. A `surface_container_highest` element on a `surface` background provides enough contrast for "embedded" content.
*   **Ambient Shadows:** For elements that truly "float" (e.g., active video controls), use an extra-diffused shadow: `box-shadow: 0 20px 40px rgba(39, 46, 66, 0.06)`. Note the use of the `on_surface` color for the shadow tint—never use pure black.
*   **The "Ghost Border" Fallback:** If a boundary is strictly required for accessibility (e.g., input fields), use the `outline_variant` token at 20% opacity. 

---

## 5. Components

### Signature Buttons
*   **Primary:** Rounded `full` (pill-shaped). Background: `primary` gradient. Text: `on_primary`. 
*   **Interaction:** On hover, the button should lift slightly (`transform: translateY(-2px)`) and the shadow should deepen.
*   **Tertiary:** No background. Use `primary` text with a `0.5rem` bottom-aligned animated underline that expands on hover.

### Learning Cards
*   **Style:** `xl` (1.5rem) corner radius. 
*   **Layout:** No dividers. Use `surface_container_lowest` for the card body. 
*   **Visual Interest:** Incorporate a "floating accent" in the top right corner—a small decorative shape using `secondary_container` to indicate the lesson category.

### Progress Interactive Elements
*   **Track:** Use `surface_variant`.
*   **Indicator:** A gradient of `secondary` to `secondary_fixed_dim`. 
*   **Motion:** Use a "spring" physics animation for progress bar fills to make the learning feel responsive and alive.

### Input Fields
*   **Background:** `surface_container_low`.
*   **Active State:** Transition to `surface_container_lowest` with a 2px "Ghost Border" using `primary`. No harsh focus rings; use a soft glow.

---

## 6. Motion & Interaction

To move beyond the "template" feel, motion must be intentional:
*   **Page Transitions:** Content should not just appear. Use a staggered "Slide-Up + Fade" effect.
    *   *Keyframe:* `opacity: 0; transform: translateY(20px)` to `opacity: 1; transform: translateY(0)`.
*   **Hover States:** When hovering over a lesson card, use a subtle `scale(1.02)` and shift the `primary_container` background to a slightly brighter `surface_bright` to "illuminate" the choice.

---

## 7. Do's and Don'ts

### Do
*   **Do** use asymmetrical layouts (e.g., a wide video player offset by a narrower sidebar).
*   **Do** use `full` roundedness for interactive elements (buttons/chips) to make them feel friendly and "touchable."
*   **Do** lean heavily on the `surface_container` tiers to create hierarchy.

### Don't
*   **Don't** use 1px solid black or grey borders. They break the "editorial" flow.
*   **Don't** use standard "drop shadows" with high opacity.
*   **Don't** overcrowd the screen. If a section feels "busy," increase the vertical spacing by 2x using our spacing scale.
*   **Don't** use pure white backgrounds for everything. Utilize `surface` (#f6f6ff) to reduce eye strain during long learning sessions.

---

## 8. Closing Director's Note
This system is about **intent**. Every pixel should feel like it was placed there to facilitate the beauty of sign language. When in doubt, simplify the container and amplify the content. Let the typography and the soft layering do the heavy lifting.
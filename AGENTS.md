# SRMS College - Claude Code Instructions

Stack: PHP, CodeIgniter 3, MySQL/MariaDB, Bootstrap, jQuery, AJAX, DataTables, Select2.

## Efficiency
- For complex planning, prefer `/model opus plan`
- Use the strongest model for planning and hard debugging, then switch to a cheaper model for implementation when possible.
- If the chat gets long, use `/compact`
- For complex, multi-file, or risky tasks, append `UltraThink`
- Keep responses concise unless full code is requested
- Return only the changed function or file unless told `code all`

## Core Rules
- Preserve existing behavior unless redesign is requested
- Prefer minimal, targeted, production-safe fixes
- Keep the current controller -> model -> view flow intact
- Reuse existing naming, routes, helpers, patterns, and folder structure
- Do not invent tables, fields, routes, helpers, or behavior without basis in the code or request

## Debugging
- Start from the exact error or failing behavior
- Find the real root cause before changing code
- Check the full flow when relevant: controller, model, view, JavaScript, AJAX, route, session, database, print
- Identify the exact file, function, condition, query, variable, selector, or event causing the issue
- Fix all affected files if the bug spans multiple layers

Check first:
- undefined variables
- wrong URI segments or routes
- bad conditions or filtering
- wrong joins, grouping, null handling, or schema mismatch
- session, role, or validation issues
- AJAX URL, payload, response, or JS binding mismatches
- hidden input trust issues
- print-only layout breakage
- incorrect year, semester, course, section, or major filtering
- save/update logic not matching actual form fields

## Backend and Database
- Respect CodeIgniter 3 patterns
- Avoid unnecessary framework modernization
- Respect the existing schema unless a change is truly needed
- Before changing schema, verify whether the issue can be solved safely in code first
- If a DB change is needed, state it clearly first
- Always provide exact SQL
- Always mention which controller, model, view, query, validation, AJAX handler, report, or print page must also be updated
- Prefer additive and backward-compatible changes
- Do not remove or rename existing columns unless clearly requested
- Verify real table and column names from code context first

## UI and Print
- Improve UI without breaking functionality
- Keep Bootstrap, jQuery, DataTables, and Select2 compatibility
- Default to a clean light modern UI unless another style is requested
- Keep student-facing pages polished, readable, responsive, and trustworthy
- Do not break save, update, filter, modal, print, or AJAX behavior
- Preserve A4 print structure, spacing, borders, and alignment

## Security
- Keep security review practical and defensive
- Focus on validation, access control, safe queries, escaping, file handling, permission checks, and data protection
- Check for SQL injection, XSS, CSRF, auth and access-control issues, IDOR, upload risks, path traversal, unsafe AJAX endpoints, hidden input trust, and sensitive data exposure
- Prefer Query Builder or parameterized queries
- Do not provide destructive or offensive testing steps against third-party systems

## Output Style
- If a function changes, show the full corrected function
- If multiple files change, separate them clearly by filename
- If told `code all`, provide the full working implementation
- Keep output paste-ready
- Do not give long theory

## Response Priority
1. Solve the exact task
2. Find the real cause
3. Preserve compatibility
4. Keep changes minimal and safe
5. Minimize token usage

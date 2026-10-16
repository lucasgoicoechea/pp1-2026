
const SUPABASE_URL = "https://hbndrburdaqmuhlgveww.supabase.co";
const SUPABASE_PUBLISHABLE_KEY = "sb_publishable_pHIBHaxKLiqSYDqUrvgqFw_U8E0-BDA";

window.supabaseClient = supabase.createClient(
    SUPABASE_URL,
    SUPABASE_PUBLISHABLE_KEY
);

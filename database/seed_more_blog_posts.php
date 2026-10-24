<?php
require_once __DIR__ . '/../config/db.php';
$pdo = get_pdo();

$posts = [
    [
        'slug' => 'trademark-objection-vs-opposition-deadlines-strategies',
        'title' => 'Trademark Objection vs Opposition: Critical Deadlines & Legal Defense Strategies',
        'category' => 'Trademark Law',
        'read_time' => '5 min read',
        'is_featured' => 1,
        'excerpt' => 'Understanding the distinct difference between an examination objection raised by the Trademark Registry under Section 9 or 11 and a third-party opposition filed under Section 21.',
        'content' => '<h2>Understanding Examination Objections (Sections 9 & 11)</h2>
<p>When you file a Trademark application in India, the Registrar examines the mark against absolute grounds for refusal (Section 9: lack of distinctiveness, descriptive terms, generic phrases) and relative grounds (Section 11: similarity with existing registered trademarks in identical or related classes).</p>
<p>If an examination report raises objections, the applicant must file a formal written response within <strong>30 days</strong> from the receipt of the report. A well-reasoned response drafted by a registered attorney citing user affidavit evidence, territorial distinctiveness, and judicial precedents can convince the examiner to accept the mark without a hearing.</p>

<h2>Third-Party Oppositions (Section 21)</h2>
<p>Once a mark is accepted by the examiner, it is published in the official <strong>Trade Marks Journal</strong>. Any third party who believes the mark conflicts with their prior brand rights has a strict statutory window of <strong>4 months</strong> (non-extendable) to file a formal Notice of Opposition on Form TM-O.</p>
<p>Failure to respond to an opposition notice with a Counter-Statement on Form TM-O within <strong>2 months</strong> will cause the trademark application to be deemed abandoned by operation of law.</p>

<h2>Best Practices to Safeguard Your Brand</h2>
<ul>
    <li><strong>Conduct Exhaustive Prior Search:</strong> Search phonetic, visual, and conceptual similarities across classes before filing.</li>
    <li><strong>Maintain Proof of Commercial Use:</strong> Invoices, packaging photos, domain registrations, and tax filings establishing prior continuous use.</li>
    <li><strong>Proactive Trademark Journal Watching:</strong> Monitor competitor filings weekly to catch infringing marks before they gain statutory registration.</li>
</ul>',
        'author_name' => 'Advocate R. K. Verma, Senior IPR Counsel',
        'published_date' => '2026-10-15',
        'meta_title' => 'Trademark Objection vs Opposition: Legal Differences & Deadlines | Glow Well',
        'meta_description' => 'Detailed guide on handling Indian Trademark Examination Objections under Sections 9 & 11 and defending against Journal Oppositions under Section 21.'
    ],
    [
        'slug' => 'how-startups-secure-provisional-patents-budget-india',
        'title' => 'How Tech & Biotech Startups Can File Provisional Patents on a Budget in India',
        'category' => 'Patent Law',
        'read_time' => '6 min read',
        'is_featured' => 1,
        'excerpt' => 'A step-by-step roadmap for inventors, college incubators, and early-stage ventures to establish international priority dates without spending enormous legal fees upfront.',
        'content' => '<h2>Why the Provisional Patent is a Startup\'s Best Friend</h2>
<p>India follows a <strong>"first to file"</strong> patent system. This means whoever files the application first gets priority over an identical invention, regardless of who invented it first in a lab or workshop. However, early-stage innovations often undergo iterative engineering before achieving commercial finality.</p>
<p>Filing a <strong>Provisional Specification</strong> allows the inventor to establish an incontrovertible priority date at a fraction of the cost, securing the coveted "Patent Pending" status while granting a full <strong>12-month window</strong> to file the Complete Specification.</p>

<h2>Statutory Fee Concessions for Startups & MSMEs</h2>
<p>Under the amended Indian Patent Rules, recognized Startups (DPIIT registered), MSMEs, and educational institutions enjoy an <strong>80% reduction in official statutory fees</strong> compared to large corporations. The government filing fee for an e-filed patent application by an individual or startup is only ₹1,600 compared to ₹8,000 for large entities.</p>

<h2>Key Steps to Drafting an Effective Provisional Specification</h2>
<ul>
    <li><strong>Clear Field of Invention:</strong> State the exact technical domain and problem being solved.</li>
    <li><strong>Broad Working Description:</strong> Describe the underlying architecture, process flow, and component interactions thoroughly.</li>
    <li><strong>Avoid Claim Omissions:</strong> While claims are not mandatory in a provisional specification, outlining the inventive core ensures your priority date holds up during national phase entries under the PCT.</li>
</ul>',
        'author_name' => 'Dr. A. K. Sinha, Registered Patent Attorney',
        'published_date' => '2026-10-12',
        'meta_title' => 'Filing Provisional Patents for Startups in India | Glow Well',
        'meta_description' => 'Learn how Indian startups and inventors can protect their novel inventions using cost-effective provisional patent filings and government fee subsidies.'
    ],
    [
        'slug' => 'pvt-ltd-vs-llp-incorporation-roadmap-bihar-entrepreneurs',
        'title' => 'Private Limited Company vs LLP: The Right Corporate Structure for Eastern India Startups',
        'category' => 'Corporate Law',
        'read_time' => '5 min read',
        'is_featured' => 1,
        'excerpt' => 'Comparing liability protection, compliance burden, VC fundraising eligibility, and tax rates between Pvt Ltd Companies and LLPs under the MCA SPICe+ regime.',
        'content' => '<h2>Choosing the Right Business Vehicle</h2>
<p>One of the earliest decisions facing entrepreneurs in Patna, Bihar, and across Eastern India is choosing between incorporating a <strong>Private Limited (Pvt Ltd) Company</strong> or registering a <strong>Limited Liability Partnership (LLP)</strong>. Both structures offer limited liability protection, ensuring personal assets of promoters remain insulated from commercial business debts.</p>

<h2>When to Choose a Private Limited Company</h2>
<p>If your startup intends to raise venture capital, issue Employee Stock Options (ESOPs), or participate in institutional equity funding, a Private Limited Company is the standard requirement. Angels, VCs, and institutional funds cannot invest in LLPs due to partnership profit-sharing structures.</p>

<h2>When to Choose a Limited Liability Partnership (LLP)</h2>
<p>For service consultancies, family businesses, professional firms, and bootstrapped businesses that do not plan to seek external equity funding, an LLP offers substantial cost savings. LLPs do not require mandatory statutory audit unless turnover exceeds ₹40 Lakhs or capital contribution exceeds ₹25 Lakhs, drastically reducing annual compliance overheads.</p>

<h2>Fast-Track Registration via MCA SPICe+ Portal</h2>
<p>With the Ministry of Corporate Affairs SPICe+ (INC-32) integrated single-window system, our corporate team can incorporate a company in <strong>3 to 5 business days</strong>, bundling DIN allotment, PAN, TAN, EPFO, ESIC, Professional Tax, and bank account opening in one unified submission.</p>',
        'author_name' => 'Corporate Legal Advisory Cell, Patna',
        'published_date' => '2026-10-08',
        'meta_title' => 'Pvt Ltd vs LLP: Startup Incorporation Guide | Glow Well Consultants',
        'meta_description' => 'Comprehensive comparison of Private Limited Company and Limited Liability Partnership (LLP) for Indian startups and MSMEs.'
    ]
];

foreach ($posts as $p) {
    $stmt = $pdo->prepare("SELECT id FROM news WHERE slug = ?");
    $stmt->execute([$p['slug']]);
    if (!$stmt->fetch()) {
        $ins = $pdo->prepare("INSERT INTO news (slug, title, category, read_time, is_featured, excerpt, content, author_name, published_date, meta_title, meta_description, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'published')");
        $ins->execute([
            $p['slug'], $p['title'], $p['category'], $p['read_time'], $p['is_featured'],
            $p['excerpt'], $p['content'], $p['author_name'], $p['published_date'],
            $p['meta_title'], $p['meta_description']
        ]);
        echo "Inserted post: " . $p['slug'] . "\n";
    } else {
        echo "Post already exists: " . $p['slug'] . "\n";
    }
}

echo "Blog posts ready!\n";

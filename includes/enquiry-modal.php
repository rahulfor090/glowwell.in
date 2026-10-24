<!-- Global Consultation Modal -->
<div class="modal-overlay" id="consultationModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-card">
        <div class="modal-header">
            <h3 id="modalTitle"><i class="fa fa-shield text-gold"></i> Request Confidential Consultation</h3>
            <button class="modal-close-btn" id="closeModalBtn" aria-label="Close dialog">&times;</button>
        </div>
        <div class="modal-body">
            <p style="color: var(--text-muted); font-size: 0.92rem; margin-bottom: 20px;">
                Speak directly with an experienced IPR attorney or corporate consultant. We will review your requirements and provide cost estimates within 24 hours.
            </p>
            <form action="<?= BASE_URL ?>/process_enquiry.php" method="POST" class="quick-modal-form">
                <?= csrf_field() ?>
                <input type="hidden" name="source" value="modal">
                <input type="hidden" name="return_url" value="<?= e($_SERVER['REQUEST_URI']) ?>">

                <div class="form-row">
                    <div class="form-group" style="margin-bottom: 14px;">
                        <label for="modal_name" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:4px;">Full Name *</label>
                        <input type="text" id="modal_name" name="name" class="form-control" placeholder="e.g. Ramesh Kumar" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 14px;">
                        <label for="modal_phone" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:4px;">Phone / WhatsApp *</label>
                        <input type="tel" id="modal_phone" name="phone" class="form-control" placeholder="+91 9876543210" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="margin-bottom: 14px;">
                        <label for="modal_email" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:4px;">Email Address *</label>
                        <input type="email" id="modal_email" name="email" class="form-control" placeholder="your@company.com" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 14px;">
                        <label for="modal_service" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:4px;">Service Required *</label>
                        <select id="modal_service" name="service_interest" class="form-control" required>
                            <option value="">Select Practice Area</option>
                            <option value="Trademark Registration">Trademark Registration</option>
                            <option value="Patent Law & Filing">Patent Law &amp; Filing</option>
                            <option value="Copyright Protection">Copyright Protection</option>
                            <option value="Industrial Designs">Industrial Designs (Designs Act 2000)</option>
                            <option value="Geographical Indication">Geographical Indication (GI)</option>
                            <option value="ISO Certification">ISO Certification (9001/14001/27001)</option>
                            <option value="Company Incorporation">Company / LLP Registration</option>
                            <option value="Cyber Law Advisory">Cyber Law &amp; Digital Rights</option>
                            <option value="IP Litigation & Dispute">IP Litigation &amp; Infringement Dispute</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 18px;">
                    <label for="modal_message" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:4px;">Describe Your Requirement</label>
                    <textarea id="modal_message" name="message" class="form-control" rows="3" placeholder="Briefly mention your brand name, invention, or inquiry..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                    <i class="fa fa-paper-plane"></i> Submit Consultation Request
                </button>
            </form>
        </div>
    </div>
</div>

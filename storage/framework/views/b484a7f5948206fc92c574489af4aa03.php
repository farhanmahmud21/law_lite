

<?php $__env->startSection('no-padding', true); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .ai-hero {
        background: var(--gradient-primary);
        padding: 5rem 0;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .ai-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 80%;
        height: 200%;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 60%);
        animation: pulse-bg 8s ease-in-out infinite;
    }

    @keyframes pulse-bg {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .ai-hero-badge {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .feature-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        padding: 1.75rem;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10b981, #3b82f6);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-card.active {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2), 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .feature-card.active::before {
        transform: scaleX(1);
    }

    .feature-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.25rem;
        position: relative;
    }

    .feature-icon.blue { 
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(37, 99, 235, 0.15) 100%); 
        color: #3b82f6; 
    }
    .feature-icon.green { 
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%); 
        color: #10b981; 
    }
    .feature-icon.purple { 
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%); 
        color: #8b5cf6; 
    }
    .feature-icon.orange { 
        background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(234, 88, 12, 0.15) 100%); 
        color: #f97316; 
    }
    .feature-icon.red { 
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.15) 100%); 
        color: #ef4444; 
    }
    .feature-icon.teal { 
        background: linear-gradient(135deg, rgba(20, 184, 166, 0.15) 0%, rgba(13, 148, 136, 0.15) 100%); 
        color: #14b8a6; 
    }
    .feature-icon.indigo { 
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(79, 70, 229, 0.15) 100%); 
        color: #6366f1; 
    }

    .ai-workspace {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 24px;
        padding: 2.5rem;
        min-height: 500px;
        border: 1px solid #e2e8f0;
        box-shadow: var(--shadow-lg);
    }

    .tool-panel {
        display: none;
    }

    .tool-panel.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .result-box {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 2rem;
        margin-top: 1.5rem;
        white-space: pre-wrap;
        font-size: 0.95rem;
        line-height: 1.8;
        max-height: 500px;
        overflow-y: auto;
        box-shadow: var(--shadow-sm);
    }

    .result-box.loading {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 200px;
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #e2e8f0;
        border-top-color: #10b981;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .quick-action {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .quick-action:hover {
        background: #e2e8f0;
        border-color: #cbd5e1;
    }

    .lang-toggle {
        display: inline-flex;
        background: #e2e8f0;
        border-radius: 8px;
        padding: 4px;
    }

    .lang-toggle button {
        border: none;
        background: transparent;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .lang-toggle button.active {
        background: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .bd-flag {
        width: 20px;
        height: 14px;
        display: inline-block;
        margin-right: 6px;
        background: #006a4e;
        border-radius: 2px;
        position: relative;
    }

    .bd-flag::after {
        content: '';
        position: absolute;
        width: 8px;
        height: 8px;
        background: #f42a41;
        border-radius: 50%;
        top: 50%;
        left: 45%;
        transform: translate(-50%, -50%);
    }

    /* Dark mode overrides for AI features */
    html[data-theme="dark"] .ai-workspace {
        background: linear-gradient(135deg, #0a1628 0%, #0d1b30 100%);
        border-color: rgba(255,255,255,0.08);
    }
    html[data-theme="dark"] .feature-card {
        background: rgba(11, 18, 32, 0.95);
        border-color: rgba(255,255,255,0.08);
    }
    html[data-theme="dark"] .feature-card h6 {
        color: #e6eef8;
    }
    html[data-theme="dark"] .feature-card p {
        color: #94a3b8;
    }
    html[data-theme="dark"] .result-box {
        background: rgba(11, 18, 32, 0.95);
        border-color: rgba(255,255,255,0.08);
        color: #e6eef8;
    }
    html[data-theme="dark"] .quick-action {
        background: rgba(255,255,255,0.05);
        border-color: rgba(255,255,255,0.1);
        color: #cbd5e1;
    }
    html[data-theme="dark"] .quick-action:hover {
        background: rgba(255,255,255,0.1);
    }
    html[data-theme="dark"] .lang-toggle {
        background: rgba(255,255,255,0.08);
    }
    html[data-theme="dark"] .lang-toggle button {
        color: #cbd5e1;
    }
    html[data-theme="dark"] .lang-toggle button.active {
        background: rgba(52, 211, 153, 0.2);
        color: #34d399;
    }

    /* Dark mode select and option styling */
    html[data-theme="dark"] .form-select,
    html[data-theme="dark"] select {
        background-color: #0f172a !important;
        color: #e2e8f0 !important;
        border-color: rgba(255, 255, 255, 0.15) !important;
    }

    html[data-theme="dark"] .form-select option,
    html[data-theme="dark"] select option {
        background-color: #0f172a !important;
        color: #e2e8f0 !important;
    }

    html[data-theme="dark"] .form-label,
    html[data-theme="dark"] label {
        color: #cbd5e1 !important;
    }

    html[data-theme="dark"] .tool-section h5,
    html[data-theme="dark"] .tool-section p,
    html[data-theme="dark"] .tool-section span {
        color: #e2e8f0 !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="ai-hero">
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="ai-hero-badge">
                        <span class="bd-flag"></span>
                        <?php echo e(__('messages.ai_hero_badge')); ?>

                    </span>
                </div>
                <h1 class="display-4 fw-bold mb-4" style="letter-spacing: -0.03em;">
                    <?php echo e(__('messages.ai_hero_title')); ?>

                </h1>
                <p class="lead opacity-75 mb-4" style="font-size: 1.25rem; line-height: 1.8; max-width: 600px;">
                    <?php echo e(__('messages.ai_hero_desc')); ?>

                </p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div class="position-relative">
                    <div style="width: 200px; height: 200px; margin: 0 auto; background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(16, 185, 129, 0.05) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; animation: float 3s ease-in-out infinite;">
                        <i class="bi bi-robot" style="font-size: 6rem; color: rgba(255,255,255,0.9);"></i>
                    </div>
                    <div style="position: absolute; top: 10%; right: 10%; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 0.75rem 1rem; border-radius: 12px; font-size: 0.875rem; animation: float 3s ease-in-out infinite; animation-delay: 0.5s;">
                        <i class="bi bi-cpu me-2" style="color: #10b981;"></i>Smart AI
                    </div>
                    <div style="position: absolute; bottom: 10%; left: 0%; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 0.75rem 1rem; border-radius: 12px; font-size: 0.875rem; animation: float 3s ease-in-out infinite; animation-delay: 1s;">
                        <i class="bi bi-translate me-2" style="color: #f59e0b;"></i>Bilingual
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Feature Cards -->
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-grid-3x3-gap me-2" style="color: #10b981;"></i>
                    <?php echo e(__('messages.select_ai_tools')); ?>

                </h5>
                
                <div class="row g-3">
                    <!-- Dhara Lookup -->
                    <div class="col-6">
                        <div class="feature-card active" data-tool="dhara" onclick="selectTool('dhara')">
                            <div class="feature-icon blue">
                                <i class="bi bi-book"></i>
                            </div>
                            <h6 class="fw-bold mb-1"><?php echo e(__('messages.tool_dhara')); ?></h6>
                            <small class="text-muted"><?php echo e(__('messages.tool_dhara_desc')); ?></small>
                        </div>
                    </div>

                    <!-- Legal Terms -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="terms" onclick="selectTool('terms')">
                            <div class="feature-icon green">
                                <i class="bi bi-translate"></i>
                            </div>
                            <h6 class="fw-bold mb-1"><?php echo e(__('messages.tool_terms')); ?></h6>
                            <small class="text-muted"><?php echo e(__('messages.tool_terms_desc')); ?></small>
                        </div>
                    </div>

                    <!-- Document Analysis -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="document" onclick="selectTool('document')">
                            <div class="feature-icon purple">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <h6 class="fw-bold mb-1"><?php echo e(__('messages.tool_document')); ?></h6>
                            <small class="text-muted"><?php echo e(__('messages.tool_document_desc')); ?></small>
                        </div>
                    </div>

                    <!-- Case Predictor -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="case" onclick="selectTool('case')">
                            <div class="feature-icon orange">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <h6 class="fw-bold mb-1"><?php echo e(__('messages.tool_case')); ?></h6>
                            <small class="text-muted"><?php echo e(__('messages.tool_case_desc')); ?></small>
                        </div>
                    </div>

                    <!-- Legal Procedure -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="procedure" onclick="selectTool('procedure')">
                            <div class="feature-icon teal">
                                <i class="bi bi-list-check"></i>
                            </div>
                            <h6 class="fw-bold mb-1"><?php echo e(__('messages.tool_procedure')); ?></h6>
                            <small class="text-muted"><?php echo e(__('messages.tool_procedure_desc')); ?></small>
                        </div>
                    </div>

                    <!-- Rights Checker -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="rights" onclick="selectTool('rights')">
                            <div class="feature-icon red">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h6 class="fw-bold mb-1"><?php echo e(__('messages.tool_rights')); ?></h6>
                            <small class="text-muted"><?php echo e(__('messages.tool_rights_desc')); ?></small>
                        </div>
                    </div>

                    <!-- Draft Document -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="draft" onclick="selectTool('draft')">
                            <div class="feature-icon indigo">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            <h6 class="fw-bold mb-1"><?php echo e(__('messages.tool_draft')); ?></h6>
                            <small class="text-muted"><?php echo e(__('messages.tool_draft_desc')); ?></small>
                        </div>
                    </div>

                    <!-- General Question -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="question" onclick="selectTool('question')">
                            <div class="feature-icon blue">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <h6 class="fw-bold mb-1"><?php echo e(__('messages.tool_question')); ?></h6>
                            <small class="text-muted"><?php echo e(__('messages.tool_question_desc')); ?></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AI Workspace -->
            <div class="col-lg-8">
                <div class="ai-workspace">
                    <!-- Dhara Tool -->
                    <div class="tool-panel active" id="tool-dhara">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-book text-primary me-2"></i>
                            <?php echo e(__('messages.dhara_title')); ?>

                        </h5>
                        <p class="text-muted mb-4"><?php echo e(__('messages.dhara_desc')); ?></p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.law_name')); ?></label>
                            <select class="form-select" id="dhara-law">
                                <option value="<?php echo e(__('messages.penal_code_1860')); ?>"><?php echo e(__('messages.penal_code_1860')); ?></option>
                                <option value="<?php echo e(__('messages.crpc_1898')); ?>"><?php echo e(__('messages.crpc_1898')); ?></option>
                                <option value="<?php echo e(__('messages.cpc_1908')); ?>"><?php echo e(__('messages.cpc_1908')); ?></option>
                                <option value="<?php echo e(__('messages.evidence_act_1872')); ?>"><?php echo e(__('messages.evidence_act_1872')); ?></option>
                                <option value="<?php echo e(__('messages.property_transfer_act')); ?>"><?php echo e(__('messages.property_transfer_act')); ?></option>
                                <option value="<?php echo e(__('messages.contract_act_1872')); ?>"><?php echo e(__('messages.contract_act_1872')); ?></option>
                                <option value="<?php echo e(__('messages.women_children_act')); ?>"><?php echo e(__('messages.women_children_act')); ?></option>
                                <option value="<?php echo e(__('messages.family_court_ordinance')); ?>"><?php echo e(__('messages.family_court_ordinance')); ?></option>
                                <option value="<?php echo e(__('messages.labour_act_2006')); ?>"><?php echo e(__('messages.labour_act_2006')); ?></option>
                                <option value="<?php echo e(__('messages.consumer_rights_act')); ?>"><?php echo e(__('messages.consumer_rights_act')); ?></option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.section_number')); ?></label>
                            <input type="text" class="form-control" id="dhara-section" placeholder="<?php echo e(__('messages.section_placeholder')); ?>">
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="quick-action" onclick="setDhara('302')"><?php echo e(__('messages.section_302')); ?></span>
                            <span class="quick-action" onclick="setDhara('420')"><?php echo e(__('messages.section_420')); ?></span>
                            <span class="quick-action" onclick="setDhara('376')"><?php echo e(__('messages.section_376')); ?></span>
                            <span class="quick-action" onclick="setDhara('497')"><?php echo e(__('messages.section_497')); ?></span>
                        </div>

                        <button class="btn btn-primary px-4" onclick="searchDhara()">
                            <i class="bi bi-search me-2"></i><?php echo e(__('messages.btn_search')); ?>

                        </button>

                        <div id="dhara-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Legal Terms Tool -->
                    <div class="tool-panel" id="tool-terms">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-translate text-success me-2"></i>
                            <?php echo e(__('messages.terms_title')); ?>

                        </h5>
                        <p class="text-muted mb-4"><?php echo e(__('messages.terms_desc')); ?></p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.legal_term')); ?></label>
                            <input type="text" class="form-control" id="term-input" placeholder="<?php echo e(__('messages.term_placeholder')); ?>">
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="quick-action" onclick="setTerm('<?php echo e(__('messages.term_bail')); ?>')"><?php echo e(__('messages.term_bail')); ?></span>
                            <span class="quick-action" onclick="setTerm('<?php echo e(__('messages.term_heba')); ?>')"><?php echo e(__('messages.term_heba')); ?></span>
                            <span class="quick-action" onclick="setTerm('<?php echo e(__('messages.term_waqf')); ?>')"><?php echo e(__('messages.term_waqf')); ?></span>
                            <span class="quick-action" onclick="setTerm('<?php echo e(__('messages.term_heir')); ?>')"><?php echo e(__('messages.term_heir')); ?></span>
                            <span class="quick-action" onclick="setTerm('<?php echo e(__('messages.term_deed')); ?>')"><?php echo e(__('messages.term_deed')); ?></span>
                            <span class="quick-action" onclick="setTerm('<?php echo e(__('messages.term_joint')); ?>')"><?php echo e(__('messages.term_joint')); ?></span>
                            <span class="quick-action" onclick="setTerm('<?php echo e(__('messages.term_complaint')); ?>')"><?php echo e(__('messages.term_complaint')); ?></span>
                            <span class="quick-action" onclick="setTerm('<?php echo e(__('messages.term_plaint')); ?>')"><?php echo e(__('messages.term_plaint')); ?></span>
                        </div>

                        <button class="btn btn-success px-4" onclick="searchTerm()">
                            <i class="bi bi-search me-2"></i><?php echo e(__('messages.btn_meaning')); ?>

                        </button>

                        <div id="term-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Document Analysis Tool -->
                    <div class="tool-panel" id="tool-document">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-file-earmark-text text-purple me-2"></i>
                            <?php echo e(__('messages.document_title')); ?>

                        </h5>
                        <p class="text-muted mb-4"><?php echo e(__('messages.document_desc')); ?></p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.analysis_type')); ?></label>
                            <select class="form-select" id="analysis-type">
                                <option value="summary"><?php echo e(__('messages.analysis_summary')); ?></option>
                                <option value="legal_issues"><?php echo e(__('messages.analysis_issues')); ?></option>
                                <option value="risks"><?php echo e(__('messages.analysis_risks')); ?></option>
                                <option value="recommendations"><?php echo e(__('messages.analysis_recommendations')); ?></option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.document_text')); ?></label>
                            <textarea class="form-control" id="document-text" rows="8" placeholder="<?php echo e(__('messages.document_placeholder')); ?>"></textarea>
                        </div>

                        <button class="btn btn-primary px-4" onclick="analyzeDocument()">
                            <i class="bi bi-cpu me-2"></i><?php echo e(__('messages.btn_analyze')); ?>

                        </button>

                        <div id="document-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Case Analysis Tool -->
                    <div class="tool-panel" id="tool-case">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-graph-up-arrow text-warning me-2"></i>
                            <?php echo e(__('messages.case_title')); ?>

                        </h5>
                        <p class="text-muted mb-4"><?php echo e(__('messages.case_desc')); ?></p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.case_type')); ?></label>
                            <select class="form-select" id="case-type">
                                <option value="<?php echo e(__('messages.case_criminal')); ?>"><?php echo e(__('messages.case_criminal')); ?></option>
                                <option value="<?php echo e(__('messages.case_civil')); ?>"><?php echo e(__('messages.case_civil')); ?></option>
                                <option value="<?php echo e(__('messages.case_family')); ?>"><?php echo e(__('messages.case_family')); ?></option>
                                <option value="<?php echo e(__('messages.case_labour')); ?>"><?php echo e(__('messages.case_labour')); ?></option>
                                <option value="<?php echo e(__('messages.case_property')); ?>"><?php echo e(__('messages.case_property')); ?></option>
                                <option value="<?php echo e(__('messages.case_consumer')); ?>"><?php echo e(__('messages.case_consumer')); ?></option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.case_facts')); ?></label>
                            <textarea class="form-control" id="case-facts" rows="6" placeholder="<?php echo e(__('messages.case_placeholder')); ?>"></textarea>
                        </div>

                        <button class="btn btn-warning text-dark px-4" onclick="analyzeCase()">
                            <i class="bi bi-lightning me-2"></i><?php echo e(__('messages.btn_predict')); ?>

                        </button>

                        <div id="case-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Legal Procedure Tool -->
                    <div class="tool-panel" id="tool-procedure">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-list-check text-info me-2"></i>
                            <?php echo e(__('messages.procedure_title')); ?>

                        </h5>
                        <p class="text-muted mb-4"><?php echo e(__('messages.procedure_desc')); ?></p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.procedure_type')); ?></label>
                            <select class="form-select" id="procedure-type">
                                <option value="<?php echo e(__('messages.procedure_fir')); ?>"><?php echo e(__('messages.procedure_fir')); ?></option>
                                <option value="<?php echo e(__('messages.procedure_bail')); ?>"><?php echo e(__('messages.procedure_bail')); ?></option>
                                <option value="<?php echo e(__('messages.procedure_civil')); ?>"><?php echo e(__('messages.procedure_civil')); ?></option>
                                <option value="<?php echo e(__('messages.procedure_divorce')); ?>"><?php echo e(__('messages.procedure_divorce')); ?></option>
                                <option value="<?php echo e(__('messages.procedure_inheritance')); ?>"><?php echo e(__('messages.procedure_inheritance')); ?></option>
                                <option value="<?php echo e(__('messages.procedure_consumer')); ?>"><?php echo e(__('messages.procedure_consumer')); ?></option>
                                <option value="<?php echo e(__('messages.procedure_land')); ?>"><?php echo e(__('messages.procedure_land')); ?></option>
                                <option value="<?php echo e(__('messages.procedure_company')); ?>"><?php echo e(__('messages.procedure_company')); ?></option>
                            </select>
                        </div>

                        <button class="btn btn-info text-white px-4" onclick="getProcedure()">
                            <i class="bi bi-arrow-right-circle me-2"></i><?php echo e(__('messages.btn_guide')); ?>

                        </button>

                        <div id="procedure-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Rights Checker Tool -->
                    <div class="tool-panel" id="tool-rights">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-shield-check text-danger me-2"></i>
                            <?php echo e(__('messages.rights_title')); ?>

                        </h5>
                        <p class="text-muted mb-4"><?php echo e(__('messages.rights_desc')); ?></p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.rights_category')); ?></label>
                            <select class="form-select" id="rights-category">
                                <option value="<?php echo e(__('messages.rights_arrest')); ?>"><?php echo e(__('messages.rights_arrest')); ?></option>
                                <option value="<?php echo e(__('messages.rights_women')); ?>"><?php echo e(__('messages.rights_women')); ?></option>
                                <option value="<?php echo e(__('messages.rights_children')); ?>"><?php echo e(__('messages.rights_children')); ?></option>
                                <option value="<?php echo e(__('messages.rights_consumer')); ?>"><?php echo e(__('messages.rights_consumer')); ?></option>
                                <option value="<?php echo e(__('messages.rights_property')); ?>"><?php echo e(__('messages.rights_property')); ?></option>
                                <option value="<?php echo e(__('messages.rights_labour')); ?>"><?php echo e(__('messages.rights_labour')); ?></option>
                                <option value="<?php echo e(__('messages.rights_cyber')); ?>"><?php echo e(__('messages.rights_cyber')); ?></option>
                            </select>
                        </div>

                        <button class="btn btn-danger px-4" onclick="checkRights()">
                            <i class="bi bi-shield-check me-2"></i><?php echo e(__('messages.btn_check_rights')); ?>

                        </button>

                        <div id="rights-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Draft Document Tool -->
                    <div class="tool-panel" id="tool-draft">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-pencil-square text-indigo me-2"></i>
                            <?php echo e(__('messages.draft_title')); ?>

                        </h5>
                        <p class="text-muted mb-4"><?php echo e(__('messages.draft_desc')); ?></p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.draft_type')); ?></label>
                            <select class="form-select" id="draft-type">
                                <option value="<?php echo e(__('messages.draft_legal_notice')); ?>"><?php echo e(__('messages.draft_legal_notice')); ?></option>
                                <option value="<?php echo e(__('messages.draft_application')); ?>"><?php echo e(__('messages.draft_application')); ?></option>
                                <option value="<?php echo e(__('messages.draft_complaint')); ?>"><?php echo e(__('messages.draft_complaint')); ?></option>
                                <option value="<?php echo e(__('messages.draft_agreement')); ?>"><?php echo e(__('messages.draft_agreement')); ?></option>
                                <option value="<?php echo e(__('messages.draft_power_of_attorney')); ?>"><?php echo e(__('messages.draft_power_of_attorney')); ?></option>
                                <option value="<?php echo e(__('messages.draft_affidavit')); ?>"><?php echo e(__('messages.draft_affidavit')); ?></option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.draft_details')); ?></label>
                            <textarea class="form-control" id="draft-details" rows="6" placeholder="<?php echo e(__('messages.draft_placeholder')); ?>"></textarea>
                        </div>

                        <button class="btn btn-primary px-4" onclick="draftDocument()">
                            <i class="bi bi-file-earmark-plus me-2"></i><?php echo e(__('messages.btn_draft')); ?>

                        </button>

                        <div id="draft-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- General Question Tool -->
                    <div class="tool-panel" id="tool-question">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-chat-dots text-primary me-2"></i>
                            <?php echo e(__('messages.question_title')); ?>

                        </h5>
                        <p class="text-muted mb-4"><?php echo e(__('messages.question_desc')); ?></p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?php echo e(__('messages.your_question')); ?></label>
                            <textarea class="form-control" id="question-input" rows="4" placeholder="<?php echo e(__('messages.question_placeholder')); ?>"></textarea>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted"><?php echo e(__('messages.sample_questions')); ?>:</small>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="quick-action" onclick="setQuestion('<?php echo e(__('messages.sample_q1')); ?>')"><?php echo e(__('messages.sample_q1')); ?></span>
                                <span class="quick-action" onclick="setQuestion('<?php echo e(__('messages.sample_q2')); ?>')"><?php echo e(__('messages.sample_q2')); ?></span>
                                <span class="quick-action" onclick="setQuestion('<?php echo e(__('messages.sample_q3')); ?>')"><?php echo e(__('messages.sample_q3')); ?></span>
                            </div>
                        </div>

                        <button class="btn btn-primary px-4" onclick="askQuestion()">
                            <i class="bi bi-send me-2"></i><?php echo e(__('messages.btn_ask')); ?>

                        </button>

                        <div id="question-result" class="result-box" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const currentLang = '<?php echo e(app()->getLocale()); ?>';

function selectTool(tool) {
    document.querySelectorAll('.feature-card').forEach(card => {
        card.classList.toggle('active', card.dataset.tool === tool);
    });
    document.querySelectorAll('.tool-panel').forEach(panel => {
        panel.classList.toggle('active', panel.id === 'tool-' + tool);
    });
}

function showLoading(elementId) {
    const el = document.getElementById(elementId);
    el.style.display = 'block';
    el.classList.add('loading');
    el.innerHTML = '<div class="loading-spinner"></div>';
}

function showResult(elementId, content) {
    const el = document.getElementById(elementId);
    el.classList.remove('loading');
    el.innerHTML = formatResult(content);
}

function showError(elementId, message) {
    const el = document.getElementById(elementId);
    el.classList.remove('loading');
    el.innerHTML = `<div class="alert alert-danger mb-0"><i class="bi bi-exclamation-triangle me-2"></i>${message}</div>`;
}

function formatResult(text) {
    return text
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        .replace(/\*(.*?)\*/g, '<em>$1</em>')
        .replace(/^### (.*$)/gm, '<h5 class="mt-3 mb-2 text-primary">$1</h5>')
        .replace(/^## (.*$)/gm, '<h4 class="mt-3 mb-2 text-primary">$1</h4>')
        .replace(/^# (.*$)/gm, '<h3 class="mt-3 mb-2 text-primary">$1</h3>')
        .replace(/^- (.*$)/gm, '<li>$1</li>')
        .replace(/^(\d+)\. (.*$)/gm, '<li><strong>$1.</strong> $2</li>')
        .replace(/\n\n/g, '<br><br>');
}

async function makeRequest(url, data) {
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({...data, language: currentLang})
    });
    return response.json();
}

// Dhara Functions
function setDhara(section) {
    document.getElementById('dhara-section').value = section;
}

async function searchDhara() {
    const law = document.getElementById('dhara-law').value;
    const section = document.getElementById('dhara-section').value;
    
    if (!section) {
        alert(currentLang === 'bn' ? 'অনুগ্রহ করে ধারা নম্বর লিখুন' : 'Please enter a section number');
        return;
    }
    
    showLoading('dhara-result');
    
    try {
        const data = await makeRequest('/ai/dhara', { law_name: law, section: section });
        if (data.ok) {
            showResult('dhara-result', data.result);
        } else {
            showError('dhara-result', data.error);
        }
    } catch (e) {
        showError('dhara-result', currentLang === 'bn' ? 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।' : 'An error occurred. Please try again.');
    }
}

// Term Functions
function setTerm(term) {
    document.getElementById('term-input').value = term;
}

async function searchTerm() {
    const term = document.getElementById('term-input').value;
    
    if (!term) {
        alert(currentLang === 'bn' ? 'অনুগ্রহ করে একটি শব্দ লিখুন' : 'Please enter a term');
        return;
    }
    
    showLoading('term-result');
    
    try {
        const data = await makeRequest('/ai/legal-term', { term: term });
        if (data.ok) {
            showResult('term-result', data.result);
        } else {
            showError('term-result', data.error);
        }
    } catch (e) {
        showError('term-result', currentLang === 'bn' ? 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।' : 'An error occurred. Please try again.');
    }
}

// Document Analysis
async function analyzeDocument() {
    const text = document.getElementById('document-text').value;
    const type = document.getElementById('analysis-type').value;
    
    if (!text) {
        alert(currentLang === 'bn' ? 'অনুগ্রহ করে দলিলের টেক্সট পেস্ট করুন' : 'Please paste document text');
        return;
    }
    
    showLoading('document-result');
    
    try {
        const data = await makeRequest('/ai/analyze-document', { document_text: text, analysis_type: type });
        if (data.ok) {
            showResult('document-result', data.result);
        } else {
            showError('document-result', data.error);
        }
    } catch (e) {
        showError('document-result', currentLang === 'bn' ? 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।' : 'An error occurred. Please try again.');
    }
}

// Case Analysis
async function analyzeCase() {
    const caseType = document.getElementById('case-type').value;
    const facts = document.getElementById('case-facts').value;
    
    if (!facts) {
        alert(currentLang === 'bn' ? 'অনুগ্রহ করে মামলার তথ্য লিখুন' : 'Please enter case details');
        return;
    }
    
    showLoading('case-result');
    
    try {
        const data = await makeRequest('/ai/predict-case', { case_type: caseType, facts: facts });
        if (data.ok) {
            showResult('case-result', data.result);
        } else {
            showError('case-result', data.error);
        }
    } catch (e) {
        showError('case-result', currentLang === 'bn' ? 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।' : 'An error occurred. Please try again.');
    }
}

// Procedure
async function getProcedure() {
    const procedure = document.getElementById('procedure-type').value;
    
    showLoading('procedure-result');
    
    try {
        const data = await makeRequest('/ai/procedure', { procedure_type: procedure });
        if (data.ok) {
            showResult('procedure-result', data.result);
        } else {
            showError('procedure-result', data.error);
        }
    } catch (e) {
        showError('procedure-result', currentLang === 'bn' ? 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।' : 'An error occurred. Please try again.');
    }
}

// Rights Checker
async function checkRights() {
    const category = document.getElementById('rights-category').value;
    
    showLoading('rights-result');
    
    try {
        const data = await makeRequest('/ai/check-rights', { category: category });
        if (data.ok) {
            showResult('rights-result', data.result);
        } else {
            showError('rights-result', data.error);
        }
    } catch (e) {
        showError('rights-result', currentLang === 'bn' ? 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।' : 'An error occurred. Please try again.');
    }
}

// Draft Document
async function draftDocument() {
    const type = document.getElementById('draft-type').value;
    const details = document.getElementById('draft-details').value;
    
    if (!details) {
        alert(currentLang === 'bn' ? 'অনুগ্রহ করে বিস্তারিত তথ্য দিন' : 'Please provide details');
        return;
    }
    
    showLoading('draft-result');
    
    try {
        const data = await makeRequest('/ai/draft-document', { document_type: type, details: details });
        if (data.ok) {
            showResult('draft-result', data.result);
        } else {
            showError('draft-result', data.error);
        }
    } catch (e) {
        showError('draft-result', currentLang === 'bn' ? 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।' : 'An error occurred. Please try again.');
    }
}

// General Question
function setQuestion(question) {
    document.getElementById('question-input').value = question;
}

async function askQuestion() {
    const question = document.getElementById('question-input').value;
    
    if (!question) {
        alert(currentLang === 'bn' ? 'অনুগ্রহ করে আপনার প্রশ্ন লিখুন' : 'Please enter your question');
        return;
    }
    
    showLoading('question-result');
    
    try {
        const data = await makeRequest('/ai/question', { question: question });
        if (data.ok) {
            showResult('question-result', data.result);
        } else {
            showError('question-result', data.error);
        }
    } catch (e) {
        showError('question-result', currentLang === 'bn' ? 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।' : 'An error occurred. Please try again.');
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH G:\CG\LawLite\resources\views/ai/features.blade.php ENDPATH**/ ?>
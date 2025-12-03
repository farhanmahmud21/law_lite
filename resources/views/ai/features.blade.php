@extends('layouts.landing')

@push('styles')
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
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="ai-hero">
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="ai-hero-badge">
                        <span class="bd-flag"></span>
                        বাংলাদেশ আইন AI সহকারী
                    </span>
                </div>
                <h1 class="display-4 fw-bold mb-4" style="letter-spacing: -0.03em;">
                    AI-Powered <span style="color: #10b981;">Legal</span> Features
                </h1>
                <p class="lead opacity-75 mb-4" style="font-size: 1.25rem; line-height: 1.8; max-width: 600px;">
                    বাংলাদেশের আইন সংক্রান্ত সকল তথ্য ও সহায়তা পান AI এর মাধ্যমে। ধারা, দণ্ডবিধি, আইনি পরিভাষা, 
                    দলিল বিশ্লেষণ এবং আরও অনেক কিছু।
                </p>
                <div class="lang-toggle">
                    <button class="active" data-lang="bn" onclick="setLanguage('bn')">বাংলা</button>
                    <button data-lang="en" onclick="setLanguage('en')">English</button>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div class="position-relative">
                    <div style="width: 200px; height: 200px; margin: 0 auto; background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(16, 185, 129, 0.05) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; animation: float 3s ease-in-out infinite;">
                        <i class="bi bi-robot" style="font-size: 6rem; color: rgba(255,255,255,0.9);"></i>
                    </div>
                    <div style="position: absolute; top: 10%; right: 10%; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 0.75rem 1rem; border-radius: 12px; font-size: 0.875rem; animation: float 3s ease-in-out infinite; animation-delay: 0.5s;">
                        <i class="bi bi-cpu me-2" style="color: #10b981;"></i>Gemini AI
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
                    AI টুলস নির্বাচন করুন
                </h5>
                
                <div class="row g-3">
                    <!-- Dhara Lookup -->
                    <div class="col-6">
                        <div class="feature-card active" data-tool="dhara" onclick="selectTool('dhara')">
                            <div class="feature-icon blue">
                                <i class="bi bi-book"></i>
                            </div>
                            <h6 class="fw-bold mb-1">ধারা খুঁজুন</h6>
                            <small class="text-muted">দণ্ডবিধি, ফৌজদারি আইন</small>
                        </div>
                    </div>

                    <!-- Legal Terms -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="terms" onclick="selectTool('terms')">
                            <div class="feature-icon green">
                                <i class="bi bi-translate"></i>
                            </div>
                            <h6 class="fw-bold mb-1">আইনি পরিভাষা</h6>
                            <small class="text-muted">শব্দার্থ ও ব্যাখ্যা</small>
                        </div>
                    </div>

                    <!-- Document Analysis -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="document" onclick="selectTool('document')">
                            <div class="feature-icon purple">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <h6 class="fw-bold mb-1">দলিল বিশ্লেষণ</h6>
                            <small class="text-muted">আইনি দলিল পর্যালোচনা</small>
                        </div>
                    </div>

                    <!-- Case Predictor -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="case" onclick="selectTool('case')">
                            <div class="feature-icon orange">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <h6 class="fw-bold mb-1">মামলা বিশ্লেষণ</h6>
                            <small class="text-muted">ফলাফল পূর্বাভাস</small>
                        </div>
                    </div>

                    <!-- Legal Procedure -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="procedure" onclick="selectTool('procedure')">
                            <div class="feature-icon teal">
                                <i class="bi bi-list-check"></i>
                            </div>
                            <h6 class="fw-bold mb-1">আইনি প্রক্রিয়া</h6>
                            <small class="text-muted">ধাপে ধাপে গাইড</small>
                        </div>
                    </div>

                    <!-- Rights Checker -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="rights" onclick="selectTool('rights')">
                            <div class="feature-icon red">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h6 class="fw-bold mb-1">অধিকার জানুন</h6>
                            <small class="text-muted">নাগরিক অধিকার</small>
                        </div>
                    </div>

                    <!-- Draft Document -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="draft" onclick="selectTool('draft')">
                            <div class="feature-icon indigo">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            <h6 class="fw-bold mb-1">দলিল খসড়া</h6>
                            <small class="text-muted">নোটিশ, আবেদন</small>
                        </div>
                    </div>

                    <!-- General Question -->
                    <div class="col-6">
                        <div class="feature-card" data-tool="question" onclick="selectTool('question')">
                            <div class="feature-icon blue">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <h6 class="fw-bold mb-1">প্রশ্ন করুন</h6>
                            <small class="text-muted">যেকোনো আইনি প্রশ্ন</small>
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
                            ধারা/দণ্ডবিধি খুঁজুন
                        </h5>
                        <p class="text-muted mb-4">বাংলাদেশের যেকোনো আইনের ধারা সম্পর্কে বিস্তারিত জানুন</p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">আইনের নাম</label>
                            <select class="form-select" id="dhara-law">
                                <option value="দণ্ডবিধি ১৮৬০">দণ্ডবিধি ১৮৬০ (Penal Code)</option>
                                <option value="ফৌজদারি কার্যবিধি ১৮৯৮">ফৌজদারি কার্যবিধি ১৮৯৮ (CrPC)</option>
                                <option value="দেওয়ানি কার্যবিধি ১৯০৮">দেওয়ানি কার্যবিধি ১৯০৮ (CPC)</option>
                                <option value="সাক্ষ্য আইন ১৮৭২">সাক্ষ্য আইন ১৮৭২ (Evidence Act)</option>
                                <option value="সম্পত্তি হস্তান্তর আইন ১৮৮২">সম্পত্তি হস্তান্তর আইন ১৮৮২</option>
                                <option value="চুক্তি আইন ১৮৭২">চুক্তি আইন ১৮৭২ (Contract Act)</option>
                                <option value="নারী ও শিশু নির্যাতন দমন আইন ২০০০">নারী ও শিশু নির্যাতন দমন আইন ২০০০</option>
                                <option value="পারিবারিক আদালত অধ্যাদেশ ১৯৮৫">পারিবারিক আদালত অধ্যাদেশ ১৯৮৫</option>
                                <option value="শ্রম আইন ২০০৬">শ্রম আইন ২০০৬</option>
                                <option value="ভোক্তা অধিকার সংরক্ষণ আইন ২০০৯">ভোক্তা অধিকার সংরক্ষণ আইন ২০০৯</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">ধারা নম্বর</label>
                            <input type="text" class="form-control" id="dhara-section" placeholder="যেমন: ৩০২, ৪২০, ৩৭৬">
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="quick-action" onclick="setDhara('দণ্ডবিধি ১৮৬০', '৩০২')">ধারা ৩০২ (হত্যা)</span>
                            <span class="quick-action" onclick="setDhara('দণ্ডবিধি ১৮৬০', '৪২০')">ধারা ৪২০ (প্রতারণা)</span>
                            <span class="quick-action" onclick="setDhara('দণ্ডবিধি ১৮৬০', '৩৭৬')">ধারা ৩৭৬ (ধর্ষণ)</span>
                            <span class="quick-action" onclick="setDhara('দণ্ডবিধি ১৮৬০', '৪৯৭')">ধারা ৪৯৭</span>
                        </div>

                        <button class="btn btn-primary px-4" onclick="searchDhara()">
                            <i class="bi bi-search me-2"></i>খুঁজুন
                        </button>

                        <div id="dhara-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Legal Terms Tool -->
                    <div class="tool-panel" id="tool-terms">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-translate text-success me-2"></i>
                            আইনি পরিভাষা অভিধান
                        </h5>
                        <p class="text-muted mb-4">আইনি শব্দ ও পরিভাষার অর্থ ও ব্যাখ্যা জানুন</p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">আইনি শব্দ/পরিভাষা</label>
                            <input type="text" class="form-control" id="term-input" placeholder="যেমন: হেবা, ওয়াকফ, জামিন, আমলনামা">
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="quick-action" onclick="setTerm('জামিন')">জামিন</span>
                            <span class="quick-action" onclick="setTerm('হেবা')">হেবা</span>
                            <span class="quick-action" onclick="setTerm('ওয়াকফ')">ওয়াকফ</span>
                            <span class="quick-action" onclick="setTerm('ওয়ারিশ')">ওয়ারিশ</span>
                            <span class="quick-action" onclick="setTerm('কবলা')">কবলা</span>
                            <span class="quick-action" onclick="setTerm('এজমালি')">এজমালি</span>
                            <span class="quick-action" onclick="setTerm('নালিশ')">নালিশ</span>
                            <span class="quick-action" onclick="setTerm('আরজি')">আরজি</span>
                        </div>

                        <button class="btn btn-success px-4" onclick="searchTerm()">
                            <i class="bi bi-search me-2"></i>অর্থ জানুন
                        </button>

                        <div id="term-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Document Analysis Tool -->
                    <div class="tool-panel" id="tool-document">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-file-earmark-text text-purple me-2"></i>
                            আইনি দলিল বিশ্লেষণ
                        </h5>
                        <p class="text-muted mb-4">আপনার আইনি দলিল পেস্ট করুন এবং AI বিশ্লেষণ পান</p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">বিশ্লেষণের ধরন</label>
                            <select class="form-select" id="analysis-type">
                                <option value="summary">সারসংক্ষেপ তৈরি করুন</option>
                                <option value="legal_issues">আইনি সমস্যা চিহ্নিত করুন</option>
                                <option value="risks">ঝুঁকি বিশ্লেষণ</option>
                                <option value="recommendations">উন্নতির সুপারিশ</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">দলিলের টেক্সট</label>
                            <textarea class="form-control" id="document-text" rows="8" placeholder="আপনার আইনি দলিল এখানে পেস্ট করুন..."></textarea>
                        </div>

                        <button class="btn btn-primary px-4" onclick="analyzeDocument()">
                            <i class="bi bi-cpu me-2"></i>বিশ্লেষণ করুন
                        </button>

                        <div id="document-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Case Analysis Tool -->
                    <div class="tool-panel" id="tool-case">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-graph-up-arrow text-warning me-2"></i>
                            মামলা বিশ্লেষণ ও পূর্বাভাস
                        </h5>
                        <p class="text-muted mb-4">আপনার মামলার তথ্য দিন এবং AI বিশ্লেষণ পান</p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">মামলার ধরন</label>
                            <select class="form-select" id="case-type">
                                <option value="ফৌজদারি মামলা">ফৌজদারি মামলা</option>
                                <option value="দেওয়ানি মামলা">দেওয়ানি মামলা</option>
                                <option value="পারিবারিক মামলা">পারিবারিক মামলা</option>
                                <option value="শ্রম মামলা">শ্রম মামলা</option>
                                <option value="সম্পত্তি বিরোধ">সম্পত্তি বিরোধ</option>
                                <option value="ভোক্তা অভিযোগ">ভোক্তা অভিযোগ</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">মামলার তথ্য/ঘটনা</label>
                            <textarea class="form-control" id="case-facts" rows="6" placeholder="মামলার বিস্তারিত তথ্য এখানে লিখুন..."></textarea>
                        </div>

                        <button class="btn btn-warning text-dark px-4" onclick="analyzeCase()">
                            <i class="bi bi-lightning me-2"></i>বিশ্লেষণ করুন
                        </button>

                        <div class="alert alert-info mt-3 small">
                            <i class="bi bi-info-circle me-2"></i>
                            দ্রষ্টব্য: এটি শুধুমাত্র শিক্ষামূলক বিশ্লেষণ। প্রকৃত আইনি পরামর্শের জন্য একজন আইনজীবীর সাথে যোগাযোগ করুন।
                        </div>

                        <div id="case-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Legal Procedure Tool -->
                    <div class="tool-panel" id="tool-procedure">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-list-check text-info me-2"></i>
                            আইনি প্রক্রিয়া গাইড
                        </h5>
                        <p class="text-muted mb-4">বিভিন্ন আইনি প্রক্রিয়ার ধাপে ধাপে গাইড পান</p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">প্রক্রিয়া নির্বাচন করুন বা লিখুন</label>
                            <input type="text" class="form-control" id="procedure-input" placeholder="যেমন: জামিন আবেদন, তালাক, জমি রেজিস্ট্রেশন">
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="quick-action" onclick="setProcedure('জামিন আবেদন প্রক্রিয়া')">জামিন আবেদন</span>
                            <span class="quick-action" onclick="setProcedure('তালাক প্রক্রিয়া')">তালাক</span>
                            <span class="quick-action" onclick="setProcedure('জমি রেজিস্ট্রেশন')">জমি রেজিস্ট্রেশন</span>
                            <span class="quick-action" onclick="setProcedure('এফআইআর দায়ের')">এফআইআর দায়ের</span>
                            <span class="quick-action" onclick="setProcedure('ওয়ারিশ সনদ')">ওয়ারিশ সনদ</span>
                            <span class="quick-action" onclick="setProcedure('পাওয়ার অফ এটর্নি')">পাওয়ার অফ এটর্নি</span>
                        </div>

                        <button class="btn btn-info text-white px-4" onclick="getProcedure()">
                            <i class="bi bi-arrow-right-circle me-2"></i>গাইড দেখুন
                        </button>

                        <div id="procedure-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Rights Checker Tool -->
                    <div class="tool-panel" id="tool-rights">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-shield-check text-danger me-2"></i>
                            আপনার অধিকার জানুন
                        </h5>
                        <p class="text-muted mb-4">আপনার পরিস্থিতি বর্ণনা করুন এবং আইনি অধিকার জানুন</p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">বিভাগ</label>
                            <select class="form-select" id="rights-category">
                                <option value="consumer">ভোক্তা অধিকার</option>
                                <option value="property">সম্পত্তি অধিকার</option>
                                <option value="family">পারিবারিক আইন</option>
                                <option value="criminal">ফৌজদারি আইন</option>
                                <option value="labor">শ্রম আইন</option>
                                <option value="civil">দেওয়ানি আইন</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">আপনার পরিস্থিতি বর্ণনা করুন</label>
                            <textarea class="form-control" id="rights-situation" rows="5" placeholder="আপনার সমস্যা বা পরিস্থিতি বিস্তারিত লিখুন..."></textarea>
                        </div>

                        <button class="btn btn-danger px-4" onclick="checkRights()">
                            <i class="bi bi-shield-check me-2"></i>অধিকার জানুন
                        </button>

                        <div id="rights-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- Draft Document Tool -->
                    <div class="tool-panel" id="tool-draft">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-pencil-square text-indigo me-2"></i>
                            আইনি দলিল খসড়া
                        </h5>
                        <p class="text-muted mb-4">আইনি নোটিশ, আবেদনপত্র বা চুক্তির খসড়া তৈরি করুন</p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">দলিলের ধরন</label>
                            <select class="form-select" id="draft-type">
                                <option value="legal_notice">আইনি নোটিশ</option>
                                <option value="application">আবেদনপত্র</option>
                                <option value="affidavit">হলফনামা</option>
                                <option value="contract">চুক্তিপত্র</option>
                                <option value="complaint">অভিযোগপত্র</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">বিস্তারিত তথ্য</label>
                            <textarea class="form-control" id="draft-details" rows="6" placeholder="দলিলের জন্য প্রয়োজনীয় তথ্য দিন। যেমন: পক্ষদের নাম, ঠিকানা, বিষয়বস্তু, দাবি ইত্যাদি..."></textarea>
                        </div>

                        <button class="btn btn-primary px-4" onclick="draftDocument()">
                            <i class="bi bi-file-earmark-plus me-2"></i>খসড়া তৈরি করুন
                        </button>

                        <div id="draft-result" class="result-box" style="display: none;"></div>
                    </div>

                    <!-- General Question Tool -->
                    <div class="tool-panel" id="tool-question">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-chat-dots text-primary me-2"></i>
                            আইনি প্রশ্ন করুন
                        </h5>
                        <p class="text-muted mb-4">বাংলাদেশের আইন সম্পর্কে যেকোনো প্রশ্ন করুন</p>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">আপনার প্রশ্ন</label>
                            <textarea class="form-control" id="question-input" rows="4" placeholder="আপনার আইনি প্রশ্ন এখানে লিখুন..."></textarea>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="quick-action" onclick="setQuestion('তালাক দিতে কী কী কাগজপত্র লাগে?')">তালাকের কাগজপত্র</span>
                            <span class="quick-action" onclick="setQuestion('জমি কেনার আগে কী যাচাই করতে হয়?')">জমি কেনার টিপস</span>
                            <span class="quick-action" onclick="setQuestion('মামলা করতে কত খরচ হয়?')">মামলার খরচ</span>
                        </div>

                        <button class="btn btn-primary px-4" onclick="askQuestion()">
                            <i class="bi bi-send me-2"></i>প্রশ্ন করুন
                        </button>

                        <div id="question-result" class="result-box" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Laws Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h4 class="fw-bold mb-4 text-center">
            <i class="bi bi-bookmark-star me-2 text-primary"></i>
            বাংলাদেশের গুরুত্বপূর্ণ আইনসমূহ
        </h4>
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <div class="bg-white p-3 rounded-3 text-center h-100 border" style="cursor: pointer;" onclick="setDhara('দণ্ডবিধি ১৮৬০', ''); selectTool('dhara');">
                    <i class="bi bi-journal-text text-primary fs-3 mb-2"></i>
                    <h6 class="mb-1">দণ্ডবিধি ১৮৬০</h6>
                    <small class="text-muted">Penal Code</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="bg-white p-3 rounded-3 text-center h-100 border" style="cursor: pointer;" onclick="setDhara('ফৌজদারি কার্যবিধি ১৮৯৮', ''); selectTool('dhara');">
                    <i class="bi bi-file-earmark-ruled text-success fs-3 mb-2"></i>
                    <h6 class="mb-1">ফৌজদারি কার্যবিধি</h6>
                    <small class="text-muted">CrPC 1898</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="bg-white p-3 rounded-3 text-center h-100 border" style="cursor: pointer;" onclick="setDhara('সাক্ষ্য আইন ১৮৭২', ''); selectTool('dhara');">
                    <i class="bi bi-person-badge text-warning fs-3 mb-2"></i>
                    <h6 class="mb-1">সাক্ষ্য আইন</h6>
                    <small class="text-muted">Evidence Act 1872</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="bg-white p-3 rounded-3 text-center h-100 border" style="cursor: pointer;" onclick="setDhara('নারী ও শিশু নির্যাতন দমন আইন ২০০০', ''); selectTool('dhara');">
                    <i class="bi bi-shield-exclamation text-danger fs-3 mb-2"></i>
                    <h6 class="mb-1">নারী ও শিশু নির্যাতন দমন</h6>
                    <small class="text-muted">২০০০</small>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
let currentLanguage = 'bn';
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function setLanguage(lang) {
    currentLanguage = lang;
    document.querySelectorAll('.lang-toggle button').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.lang === lang);
    });
}

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
    // Convert markdown-like formatting
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
        body: JSON.stringify({...data, language: currentLanguage})
    });
    return response.json();
}

// Dhara Functions
function setDhara(law, section) {
    document.getElementById('dhara-law').value = law;
    document.getElementById('dhara-section').value = section;
}

async function searchDhara() {
    const law = document.getElementById('dhara-law').value;
    const section = document.getElementById('dhara-section').value;
    
    if (!section) {
        alert('অনুগ্রহ করে ধারা নম্বর লিখুন');
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
        showError('dhara-result', 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
    }
}

// Term Functions
function setTerm(term) {
    document.getElementById('term-input').value = term;
}

async function searchTerm() {
    const term = document.getElementById('term-input').value;
    
    if (!term) {
        alert('অনুগ্রহ করে একটি শব্দ লিখুন');
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
        showError('term-result', 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
    }
}

// Document Analysis
async function analyzeDocument() {
    const text = document.getElementById('document-text').value;
    const type = document.getElementById('analysis-type').value;
    
    if (!text) {
        alert('অনুগ্রহ করে দলিলের টেক্সট পেস্ট করুন');
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
        showError('document-result', 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
    }
}

// Case Analysis
async function analyzeCase() {
    const caseType = document.getElementById('case-type').value;
    const facts = document.getElementById('case-facts').value;
    
    if (!facts) {
        alert('অনুগ্রহ করে মামলার তথ্য লিখুন');
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
        showError('case-result', 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
    }
}

// Procedure
function setProcedure(procedure) {
    document.getElementById('procedure-input').value = procedure;
}

async function getProcedure() {
    const procedure = document.getElementById('procedure-input').value;
    
    if (!procedure) {
        alert('অনুগ্রহ করে প্রক্রিয়া নির্বাচন করুন');
        return;
    }
    
    showLoading('procedure-result');
    
    try {
        const data = await makeRequest('/ai/procedure', { procedure_type: procedure });
        if (data.ok) {
            showResult('procedure-result', data.result);
        } else {
            showError('procedure-result', data.error);
        }
    } catch (e) {
        showError('procedure-result', 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
    }
}

// Rights Checker
async function checkRights() {
    const category = document.getElementById('rights-category').value;
    const situation = document.getElementById('rights-situation').value;
    
    if (!situation) {
        alert('অনুগ্রহ করে আপনার পরিস্থিতি বর্ণনা করুন');
        return;
    }
    
    showLoading('rights-result');
    
    try {
        const data = await makeRequest('/ai/check-rights', { category: category, situation: situation });
        if (data.ok) {
            showResult('rights-result', data.result);
        } else {
            showError('rights-result', data.error);
        }
    } catch (e) {
        showError('rights-result', 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
    }
}

// Draft Document
async function draftDocument() {
    const type = document.getElementById('draft-type').value;
    const details = document.getElementById('draft-details').value;
    
    if (!details) {
        alert('অনুগ্রহ করে বিস্তারিত তথ্য দিন');
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
        showError('draft-result', 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
    }
}

// General Question
function setQuestion(question) {
    document.getElementById('question-input').value = question;
}

async function askQuestion() {
    const question = document.getElementById('question-input').value;
    
    if (!question) {
        alert('অনুগ্রহ করে আপনার প্রশ্ন লিখুন');
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
        showError('question-result', 'একটি ত্রুটি হয়েছে। আবার চেষ্টা করুন।');
    }
}
</script>
@endpush

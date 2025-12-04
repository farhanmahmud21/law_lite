<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService;
use App\Exceptions\GeminiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

class AiFeaturesController extends Controller
{
    protected GeminiService $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

    /**
     * Show the AI Features page
     */
    public function index(): View
    {
        return view('ai.features');
    }

    /**
     * Get Dhara (Section) information from Bangladesh laws
     */
    public function getDhara(Request $request): JsonResponse
    {
        $data = $request->validate([
            'law_name' => 'required|string',
            'section' => 'required|string',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        
        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের আইন বিশেষজ্ঞ। নিম্নলিখিত আইনের ধারা সম্পর্কে বিস্তারিত ব্যাখ্যা দিন:\n\nআইনের নাম: {$data['law_name']}\nধারা নম্বর: {$data['section']}\n\nঅনুগ্রহ করে নিম্নলিখিত বিষয়গুলো অন্তর্ভুক্ত করুন:\n১. ধারার পূর্ণ বাংলা পাঠ\n২. সহজ ভাষায় ব্যাখ্যা\n৩. শাস্তির বিধান (যদি থাকে)\n৪. প্রাসঙ্গিক উদাহরণ\n৫. সম্পর্কিত অন্যান্য ধারা"
            : "You are a Bangladesh law expert. Provide detailed explanation of the following law section:\n\nLaw Name: {$data['law_name']}\nSection Number: {$data['section']}\n\nPlease include:\n1. Full text of the section\n2. Simple explanation\n3. Punishment provisions (if any)\n4. Relevant examples\n5. Related sections";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * Get legal term definitions (Dondobidhi/Legal Dictionary)
     */
    public function getLegalTerm(Request $request): JsonResponse
    {
        $data = $request->validate([
            'term' => 'required|string',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        
        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের আইন বিশেষজ্ঞ এবং আইনি শব্দকোষ বিশেষজ্ঞ। নিম্নলিখিত আইনি শব্দ/পরিভাষার বিস্তারিত ব্যাখ্যা দিন:\n\nশব্দ/পরিভাষা: {$data['term']}\n\nঅনুগ্রহ করে নিম্নলিখিত বিষয়গুলো অন্তর্ভুক্ত করুন:\n১. সংজ্ঞা (বাংলা ও ইংরেজি)\n২. আইনি প্রেক্ষাপট\n৩. কোন আইনে ব্যবহৃত হয়\n৪. ব্যবহারিক উদাহরণ\n৫. সম্পর্কিত পরিভাষা"
            : "You are a Bangladesh law expert and legal dictionary specialist. Provide detailed explanation of the following legal term:\n\nTerm: {$data['term']}\n\nPlease include:\n1. Definition (in Bengali and English)\n2. Legal context\n3. Which laws use this term\n4. Practical examples\n5. Related terms";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * Analyze legal document
     */
    public function analyzeDocument(Request $request): JsonResponse
    {
        $data = $request->validate([
            'document_text' => 'required|string|max:10000',
            'analysis_type' => 'required|string|in:summary,legal_issues,risks,recommendations',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        $analysisType = $data['analysis_type'];
        
        $analysisInstructions = [
            'summary' => $language === 'bn' 
                ? "এই আইনি দলিলের সারসংক্ষেপ তৈরি করুন। মূল পয়েন্টগুলো, পক্ষসমূহ, এবং গুরুত্বপূর্ণ শর্তাবলী উল্লেখ করুন।"
                : "Create a summary of this legal document. Mention key points, parties involved, and important terms.",
            'legal_issues' => $language === 'bn'
                ? "এই দলিলে কোন আইনি সমস্যা বা ত্রুটি আছে কিনা চিহ্নিত করুন। বাংলাদেশের আইন অনুযায়ী বিশ্লেষণ করুন।"
                : "Identify any legal issues or defects in this document. Analyze according to Bangladesh law.",
            'risks' => $language === 'bn'
                ? "এই দলিলে কোন ঝুঁকি বা সম্ভাব্য সমস্যা আছে কিনা বিশ্লেষণ করুন। প্রতিটি পক্ষের জন্য ঝুঁকি মূল্যায়ন করুন।"
                : "Analyze any risks or potential problems in this document. Evaluate risks for each party.",
            'recommendations' => $language === 'bn'
                ? "এই দলিল উন্নত করার জন্য সুপারিশ দিন। কোন ধারা যোগ বা পরিবর্তন করা উচিত তা বলুন।"
                : "Provide recommendations to improve this document. Suggest clauses to add or modify."
        ];

        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের একজন অভিজ্ঞ আইনজীবী। নিম্নলিখিত আইনি দলিল বিশ্লেষণ করুন:\n\n{$analysisInstructions[$analysisType]}\n\nদলিল:\n{$data['document_text']}"
            : "You are an experienced lawyer in Bangladesh. Analyze the following legal document:\n\n{$analysisInstructions[$analysisType]}\n\nDocument:\n{$data['document_text']}";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * Case outcome predictor based on facts
     */
    public function predictCase(Request $request): JsonResponse
    {
        $data = $request->validate([
            'case_type' => 'required|string',
            'facts' => 'required|string|max:5000',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        
        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের একজন অভিজ্ঞ আইনজীবী এবং আইনি বিশ্লেষক। নিম্নলিখিত মামলার তথ্যের উপর ভিত্তি করে বিশ্লেষণ করুন:\n\nমামলার ধরন: {$data['case_type']}\n\nতথ্যসমূহ:\n{$data['facts']}\n\nঅনুগ্রহ করে নিম্নলিখিত বিষয়গুলো বিশ্লেষণ করুন:\n১. প্রযোজ্য আইন ও ধারাসমূহ\n২. শক্তিশালী পয়েন্টসমূহ\n৩. দুর্বল পয়েন্টসমূহ\n৪. সম্ভাব্য ফলাফল বিশ্লেষণ\n৫. আইনি কৌশল সুপারিশ\n\nদ্রষ্টব্য: এটি শুধুমাত্র শিক্ষামূলক বিশ্লেষণ, প্রকৃত আইনি পরামর্শ নয়।"
            : "You are an experienced lawyer and legal analyst in Bangladesh. Analyze the following case based on the facts:\n\nCase Type: {$data['case_type']}\n\nFacts:\n{$data['facts']}\n\nPlease analyze:\n1. Applicable laws and sections\n2. Strong points\n3. Weak points\n4. Possible outcome analysis\n5. Legal strategy recommendations\n\nNote: This is educational analysis only, not actual legal advice.";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * Get legal procedure guide
     */
    public function getProcedure(Request $request): JsonResponse
    {
        $data = $request->validate([
            'procedure_type' => 'required|string',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        
        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের আইন বিশেষজ্ঞ। নিম্নলিখিত আইনি প্রক্রিয়ার বিস্তারিত গাইড দিন:\n\nপ্রক্রিয়া: {$data['procedure_type']}\n\nঅনুগ্রহ করে নিম্নলিখিত বিষয়গুলো অন্তর্ভুক্ত করুন:\n১. ধাপে ধাপে প্রক্রিয়া\n২. প্রয়োজনীয় কাগজপত্র\n৩. কোথায় আবেদন করতে হবে\n৪. সময়সীমা ও খরচ\n৫. গুরুত্বপূর্ণ টিপস"
            : "You are a Bangladesh law expert. Provide a detailed guide for the following legal procedure:\n\nProcedure: {$data['procedure_type']}\n\nPlease include:\n1. Step by step process\n2. Required documents\n3. Where to apply\n4. Timeline and costs\n5. Important tips";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * Legal rights checker
     */
    public function checkRights(Request $request): JsonResponse
    {
        $data = $request->validate([
            'situation' => 'required|string|max:3000',
            'category' => 'required|string|in:consumer,property,family,criminal,labor,civil',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        
        $categoryNames = [
            'consumer' => $language === 'bn' ? 'ভোক্তা অধিকার' : 'Consumer Rights',
            'property' => $language === 'bn' ? 'সম্পত্তি অধিকার' : 'Property Rights',
            'family' => $language === 'bn' ? 'পারিবারিক আইন' : 'Family Law',
            'criminal' => $language === 'bn' ? 'ফৌজদারি আইন' : 'Criminal Law',
            'labor' => $language === 'bn' ? 'শ্রম আইন' : 'Labor Law',
            'civil' => $language === 'bn' ? 'দেওয়ানি আইন' : 'Civil Law',
        ];

        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের আইন বিশেষজ্ঞ। নিম্নলিখিত পরিস্থিতিতে একজন নাগরিকের কী কী আইনি অধিকার রয়েছে তা বিশ্লেষণ করুন:\n\nবিভাগ: {$categoryNames[$data['category']]}\n\nপরিস্থিতি:\n{$data['situation']}\n\nঅনুগ্রহ করে নিম্নলিখিত বিষয়গুলো অন্তর্ভুক্ত করুন:\n১. প্রযোজ্য আইনি অধিকারসমূহ\n২. সংশ্লিষ্ট আইন ও ধারা\n৩. প্রতিকার পাওয়ার উপায়\n৪. কোথায় অভিযোগ করতে হবে\n৫. সতর্কতা ও পরামর্শ"
            : "You are a Bangladesh law expert. Analyze what legal rights a citizen has in the following situation:\n\nCategory: {$categoryNames[$data['category']]}\n\nSituation:\n{$data['situation']}\n\nPlease include:\n1. Applicable legal rights\n2. Relevant laws and sections\n3. Ways to get remedy\n4. Where to file complaints\n5. Cautions and advice";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * Draft legal notice/application
     */
    public function draftDocument(Request $request): JsonResponse
    {
        $data = $request->validate([
            'document_type' => 'required|string|in:legal_notice,application,affidavit,contract,complaint',
            'details' => 'required|string|max:5000',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        
        $documentTypes = [
            'legal_notice' => $language === 'bn' ? 'আইনি নোটিশ' : 'Legal Notice',
            'application' => $language === 'bn' ? 'আবেদনপত্র' : 'Application',
            'affidavit' => $language === 'bn' ? 'হলফনামা' : 'Affidavit',
            'contract' => $language === 'bn' ? 'চুক্তিপত্র' : 'Contract',
            'complaint' => $language === 'bn' ? 'অভিযোগপত্র' : 'Complaint',
        ];

        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের একজন অভিজ্ঞ আইনজীবী। নিম্নলিখিত তথ্যের উপর ভিত্তি করে একটি {$documentTypes[$data['document_type']]} খসড়া তৈরি করুন:\n\nবিবরণ:\n{$data['details']}\n\nঅনুগ্রহ করে:\n১. সঠিক আইনি ফরম্যাট ব্যবহার করুন\n২. প্রয়োজনীয় সব অংশ অন্তর্ভুক্ত করুন\n৩. বাংলাদেশের আইন অনুযায়ী সঠিক ভাষা ব্যবহার করুন\n৪. প্রাসঙ্গিক আইনের রেফারেন্স দিন"
            : "You are an experienced lawyer in Bangladesh. Draft a {$documentTypes[$data['document_type']]} based on the following details:\n\nDetails:\n{$data['details']}\n\nPlease:\n1. Use correct legal format\n2. Include all necessary sections\n3. Use appropriate legal language as per Bangladesh law\n4. Reference relevant laws";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * AI Case Law Research - Search Bangladesh Supreme Court & High Court precedents
     */
    public function searchCaseLaw(Request $request): JsonResponse
    {
        $data = $request->validate([
            'query' => 'required|string|max:1000',
            'court' => 'nullable|string|in:supreme_court,high_court,appellate_division,all',
            'case_type' => 'nullable|string|in:civil,criminal,constitutional,writ,all',
            'year_from' => 'nullable|integer|min:1947|max:2025',
            'year_to' => 'nullable|integer|min:1947|max:2025',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        $court = $data['court'] ?? 'all';
        $caseType = $data['case_type'] ?? 'all';
        
        $courtNames = [
            'supreme_court' => $language === 'bn' ? 'সুপ্রিম কোর্ট' : 'Supreme Court',
            'high_court' => $language === 'bn' ? 'হাইকোর্ট বিভাগ' : 'High Court Division',
            'appellate_division' => $language === 'bn' ? 'আপিল বিভাग' : 'Appellate Division',
            'all' => $language === 'bn' ? 'সকল আদালত' : 'All Courts',
        ];

        $caseTypeNames = [
            'civil' => $language === 'bn' ? 'দেওয়ানি' : 'Civil',
            'criminal' => $language === 'bn' ? 'ফৌজদারি' : 'Criminal',
            'constitutional' => $language === 'bn' ? 'সাংবিধানিক' : 'Constitutional',
            'writ' => $language === 'bn' ? 'রিট' : 'Writ',
            'all' => $language === 'bn' ? 'সকল প্রকার' : 'All Types',
        ];

        $yearFilter = '';
        if (isset($data['year_from']) || isset($data['year_to'])) {
            $from = $data['year_from'] ?? 1947;
            $to = $data['year_to'] ?? 2025;
            $yearFilter = $language === 'bn' 
                ? "\nসময়কাল: {$from} থেকে {$to}" 
                : "\nTime Period: {$from} to {$to}";
        }

        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের আইনি গবেষণা বিশেষজ্ঞ এবং নজির (case law) বিশ্লেষক। নিম্নলিখিত বিষয়ে বাংলাদেশের সুপ্রিম কোর্ট ও হাইকোর্টের প্রাসঙ্গিক মামলা ও নজির খুঁজে বের করুন:

অনুসন্ধান: {$data['query']}
আদালত: {$courtNames[$court]}
মামলার ধরন: {$caseTypeNames[$caseType]}{$yearFilter}

অনুগ্রহ করে নিম্নলিখিত তথ্য প্রদান করুন:
১. প্রাসঙ্গিক মামলার তালিকা (মামলার নাম, নম্বর, বছর সহ)
২. প্রতিটি মামলার সংক্ষিপ্ত সারসংক্ষেপ
৩. মূল আইনি নীতি (ratio decidendi)
৪. কীভাবে এই নজির প্রয়োগ করা যায়
৫. সম্পর্কিত অন্যান্য মামলা

বিশেষ দ্রষ্টব্য: বাংলাদেশ আইন রিপোর্টস (BLT, BLD, DLR, BCR) থেকে সাইটেশন দিন।"
            : "You are a Bangladesh legal research expert and case law analyst. Find relevant cases and precedents from Bangladesh Supreme Court and High Court on the following topic:

Search Query: {$data['query']}
Court: {$courtNames[$court]}
Case Type: {$caseTypeNames[$caseType]}{$yearFilter}

Please provide:
1. List of relevant cases (with case name, number, and year)
2. Brief summary of each case
3. Key legal principles (ratio decidendi)
4. How these precedents can be applied
5. Related cases

Note: Provide citations from Bangladesh Law Reports (BLT, BLD, DLR, BCR).";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * AI Legal Strategy Advisor - Strategic recommendations for cases
     */
    public function getLegalStrategy(Request $request): JsonResponse
    {
        $data = $request->validate([
            'case_description' => 'required|string|max:5000',
            'case_type' => 'required|string|in:civil,criminal,family,constitutional,writ,labor,company,tax,land',
            'client_position' => 'required|string|in:plaintiff,defendant,petitioner,respondent,appellant,accused,complainant',
            'current_stage' => 'nullable|string|in:pre_filing,filed,hearing,evidence,argument,appeal',
            'budget_concern' => 'nullable|boolean',
            'urgency' => 'nullable|string|in:low,medium,high,urgent',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        
        $caseTypes = [
            'civil' => $language === 'bn' ? 'দেওয়ানি মামলা' : 'Civil Case',
            'criminal' => $language === 'bn' ? 'ফৌজদারি মামলা' : 'Criminal Case',
            'family' => $language === 'bn' ? 'পারিবারিক মামলা' : 'Family Case',
            'constitutional' => $language === 'bn' ? 'সাংবিধানিক মামলা' : 'Constitutional Case',
            'writ' => $language === 'bn' ? 'রিট পিটিশন' : 'Writ Petition',
            'labor' => $language === 'bn' ? 'শ্রম মামলা' : 'Labor Case',
            'company' => $language === 'bn' ? 'কোম্পানি মামলা' : 'Company Case',
            'tax' => $language === 'bn' ? 'কর সংক্রান্ত মামলা' : 'Tax Case',
            'land' => $language === 'bn' ? 'ভূমি মামলা' : 'Land Case',
        ];

        $positions = [
            'plaintiff' => $language === 'bn' ? 'বাদী' : 'Plaintiff',
            'defendant' => $language === 'bn' ? 'বিবাদী' : 'Defendant',
            'petitioner' => $language === 'bn' ? 'আবেদনকারী' : 'Petitioner',
            'respondent' => $language === 'bn' ? 'প্রতিপক্ষ' : 'Respondent',
            'appellant' => $language === 'bn' ? 'আপিলকারী' : 'Appellant',
            'accused' => $language === 'bn' ? 'আসামী' : 'Accused',
            'complainant' => $language === 'bn' ? 'অভিযোগকারী' : 'Complainant',
        ];

        $stages = [
            'pre_filing' => $language === 'bn' ? 'মামলা দায়েরের পূর্বে' : 'Pre-Filing Stage',
            'filed' => $language === 'bn' ? 'মামলা দায়ের হয়েছে' : 'Case Filed',
            'hearing' => $language === 'bn' ? 'শুনানি চলছে' : 'Hearing Stage',
            'evidence' => $language === 'bn' ? 'সাক্ষ্য পর্যায়' : 'Evidence Stage',
            'argument' => $language === 'bn' ? 'যুক্তি পর্যায়' : 'Argument Stage',
            'appeal' => $language === 'bn' ? 'আপিল পর্যায়' : 'Appeal Stage',
        ];

        $urgencyLevels = [
            'low' => $language === 'bn' ? 'কম জরুরি' : 'Low Urgency',
            'medium' => $language === 'bn' ? 'মাঝারি জরুরি' : 'Medium Urgency',
            'high' => $language === 'bn' ? 'বেশি জরুরি' : 'High Urgency',
            'urgent' => $language === 'bn' ? 'অতি জরুরি' : 'Very Urgent',
        ];

        $currentStage = isset($data['current_stage']) ? $stages[$data['current_stage']] : ($language === 'bn' ? 'উল্লেখ নেই' : 'Not specified');
        $urgency = isset($data['urgency']) ? $urgencyLevels[$data['urgency']] : ($language === 'bn' ? 'মাঝারি' : 'Medium');
        $budgetNote = ($data['budget_concern'] ?? false) 
            ? ($language === 'bn' ? "\nবাজেট সীমাবদ্ধতা: হ্যাঁ" : "\nBudget Constraints: Yes")
            : '';

        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের একজন শীর্ষস্থানীয় আইনি কৌশলবিদ এবং সিনিয়র অ্যাডভোকেট। নিম্নলিখিত মামলার জন্য সম্পূর্ণ আইনি কৌশল প্রদান করুন:

মামলার ধরন: {$caseTypes[$data['case_type']]}
মক্কেলের অবস্থান: {$positions[$data['client_position']]}
বর্তমান পর্যায়: {$currentStage}
জরুরিতার মাত্রা: {$urgency}{$budgetNote}

মামলার বিবরণ:
{$data['case_description']}

অনুগ্রহ করে নিম্নলিখিত বিষয়ে বিস্তারিত কৌশল দিন:

১. **প্রাথমিক মূল্যায়ন**
   - মামলার শক্তিশালী দিক
   - দুর্বল দিক ও ঝুঁকি
   - সাফল্যের সম্ভাবনা (শতকরা হারে)

২. **আইনি কৌশল**
   - মূল আইনি যুক্তি
   - বিকল্প কৌশল
   - প্রতিপক্ষের সম্ভাব্য যুক্তি ও তার জবাব

৩. **প্রযোজ্য আইন ও নজির**
   - প্রাসঙ্গিক আইন ও ধারা
   - গুরুত্বপূর্ণ নজির (case law)
   - আইনি নীতি

৪. **কার্যপদ্ধতি**
   - পরবর্তী পদক্ষেপসমূহ
   - সময়সীমা ও ডেডলাইন
   - প্রয়োজনীয় দলিলাদি

৫. **বিকল্প বিরোধ নিষ্পত্তি**
   - মধ্যস্থতার সম্ভাবনা
   - আউট অফ কোর্ট সেটেলমেন্ট
   - সালিশি বিকল্প

৬. **আনুমানিক খরচ ও সময়**
   - আদালত ফি
   - আইনজীবী ফি (গড়)
   - মামলার সম্ভাব্য সময়কাল

দ্রষ্টব্য: এটি শুধুমাত্র সাধারণ নির্দেশনা, প্রকৃত আইনি পরামর্শ নয়।"
            : "You are a top legal strategist and Senior Advocate in Bangladesh. Provide comprehensive legal strategy for the following case:

Case Type: {$caseTypes[$data['case_type']]}
Client Position: {$positions[$data['client_position']]}
Current Stage: {$currentStage}
Urgency Level: {$urgency}{$budgetNote}

Case Description:
{$data['case_description']}

Please provide detailed strategy on:

1. **Initial Assessment**
   - Strong points of the case
   - Weak points and risks
   - Probability of success (in percentage)

2. **Legal Strategy**
   - Main legal arguments
   - Alternative strategies
   - Opponent's possible arguments and rebuttals

3. **Applicable Laws & Precedents**
   - Relevant laws and sections
   - Important case laws
   - Legal principles

4. **Action Plan**
   - Next steps
   - Timelines and deadlines
   - Required documents

5. **Alternative Dispute Resolution**
   - Mediation possibilities
   - Out of court settlement options
   - Arbitration alternatives

6. **Estimated Cost & Duration**
   - Court fees
   - Lawyer fees (average)
   - Probable case duration

Note: This is general guidance only, not actual legal advice.";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * AI Court Fee Calculator - Calculate court fees based on suit value
     */
    public function calculateCourtFee(Request $request): JsonResponse
    {
        $data = $request->validate([
            'suit_value' => 'required|numeric|min:1',
            'case_type' => 'required|string|in:money_suit,property_suit,partition_suit,injunction,declaration,specific_performance,appeal,revision,writ,execution',
            'court' => 'required|string|in:civil_court,district_court,high_court,appellate_division',
            'is_government_party' => 'nullable|boolean',
            'is_appeal' => 'nullable|boolean',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        $suitValue = $data['suit_value'];
        
        $caseTypes = [
            'money_suit' => $language === 'bn' ? 'অর্থ মামলা (Money Suit)' : 'Money Suit',
            'property_suit' => $language === 'bn' ? 'সম্পত্তি মামলা' : 'Property Suit',
            'partition_suit' => $language === 'bn' ? 'বন্টন মামলা' : 'Partition Suit',
            'injunction' => $language === 'bn' ? 'নিষেধাজ্ঞা মামলা' : 'Injunction Suit',
            'declaration' => $language === 'bn' ? 'ঘোষণামূলক মামলা' : 'Declaration Suit',
            'specific_performance' => $language === 'bn' ? 'সুনির্দিষ্ট প্রতিকার মামলা' : 'Specific Performance',
            'appeal' => $language === 'bn' ? 'আপিল' : 'Appeal',
            'revision' => $language === 'bn' ? 'রিভিশন' : 'Revision',
            'writ' => $language === 'bn' ? 'রিট পিটিশন' : 'Writ Petition',
            'execution' => $language === 'bn' ? 'ডিক্রি জারি' : 'Execution',
        ];

        $courts = [
            'civil_court' => $language === 'bn' ? 'দায়রা আদালত/সিভিল কোর্ট' : 'Civil Court',
            'district_court' => $language === 'bn' ? 'জেলা জজ আদালত' : 'District Court',
            'high_court' => $language === 'bn' ? 'হাইকোর্ট বিভাগ' : 'High Court Division',
            'appellate_division' => $language === 'bn' ? 'আপিল বিভাগ' : 'Appellate Division',
        ];

        $isGovt = ($data['is_government_party'] ?? false) ? 'Yes' : 'No';
        $isAppeal = ($data['is_appeal'] ?? false) ? 'Yes' : 'No';

        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের একজন কোর্ট ফি বিশেষজ্ঞ। Court Fees Act, 1870 এবং বাংলাদেশের প্রাসঙ্গিক আইন ও বিধি অনুযায়ী নিম্নলিখিত মামলার কোর্ট ফি গণনা করুন:

মামলার মূল্য/Suit Value: ৳{$suitValue}
মামলার ধরন: {$caseTypes[$data['case_type']]}
আদালত: {$courts[$data['court']]}
সরকার কি পক্ষ?: {$isGovt}
আপিল কি না?: {$isAppeal}

অনুগ্রহ করে নিম্নলিখিত তথ্য প্রদান করুন:

১. **কোর্ট ফি গণনা**
   - Ad Valorem ফি (মূল্যানুপাতিক)
   - Fixed ফি (নির্ধারিত)
   - Process fee
   - মোট কোর্ট ফি

২. **গণনার ভিত্তি**
   - প্রযোজ্য আইন ও ধারা
   - ফি এর হার
   - ছাড় (যদি থাকে)

৩. **অতিরিক্ত খরচ**
   - Stamp duty
   - Vakalatnama fee
   - Copying/Certified copy fee
   - Miscellaneous

৪. **গুরুত্বপূর্ণ নোট**
   - ফি জমা দেওয়ার নিয়ম
   - ফি ফেরতের বিধান
   - সাধারণ ভুল এড়ানোর পরামর্শ

৫. **মোট আনুমানিক খরচ**
   - সব খরচ মিলিয়ে মোট

দ্রষ্টব্য: এটি আনুমানিক হিসাব। প্রকৃত ফি আদালতে জমা দেওয়ার সময় নিশ্চিত করুন।"
            : "You are a Bangladesh court fee expert. Calculate the court fee for the following case according to Court Fees Act, 1870 and relevant Bangladesh laws:

Suit Value: ৳{$suitValue}
Case Type: {$caseTypes[$data['case_type']]}
Court: {$courts[$data['court']]}
Is Government a Party?: {$isGovt}
Is it an Appeal?: {$isAppeal}

Please provide:

1. **Court Fee Calculation**
   - Ad Valorem fee
   - Fixed fee
   - Process fee
   - Total court fee

2. **Calculation Basis**
   - Applicable laws and sections
   - Fee rates
   - Exemptions (if any)

3. **Additional Costs**
   - Stamp duty
   - Vakalatnama fee
   - Copying/Certified copy fee
   - Miscellaneous

4. **Important Notes**
   - Fee payment rules
   - Refund provisions
   - Tips to avoid common mistakes

5. **Total Estimated Cost**
   - Grand total of all costs

Note: This is an estimate. Verify actual fee at the court during filing.";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * AI Legal Citation Generator - Proper legal citation formatting
     */
    public function generateCitation(Request $request): JsonResponse
    {
        $data = $request->validate([
            'citation_type' => 'required|string|in:case_law,statute,constitution,book,article,gazette,ordinance',
            'details' => 'required|string|max:2000',
            'format' => 'nullable|string|in:blueBook,oscola,aglc,bangladesh',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $data['language'] ?? 'bn';
        $format = $data['format'] ?? 'bangladesh';

        $citationTypes = [
            'case_law' => $language === 'bn' ? 'মামলার রায় (Case Law)' : 'Case Law',
            'statute' => $language === 'bn' ? 'আইন/বিধি' : 'Statute/Act',
            'constitution' => $language === 'bn' ? 'সংবিধান' : 'Constitution',
            'book' => $language === 'bn' ? 'আইন বই' : 'Legal Book',
            'article' => $language === 'bn' ? 'আইন প্রবন্ধ' : 'Legal Article',
            'gazette' => $language === 'bn' ? 'গেজেট' : 'Gazette',
            'ordinance' => $language === 'bn' ? 'অধ্যাদেশ' : 'Ordinance',
        ];

        $formats = [
            'blueBook' => 'Bluebook (US)',
            'oscola' => 'OSCOLA (UK)',
            'aglc' => 'AGLC (Australian)',
            'bangladesh' => $language === 'bn' ? 'বাংলাদেশ স্ট্যান্ডার্ড' : 'Bangladesh Standard',
        ];

        $prompt = $language === 'bn'
            ? "আপনি বাংলাদেশের একজন আইনি সাইটেশন বিশেষজ্ঞ। নিম্নলিখিত তথ্যের উপর ভিত্তি করে সঠিক আইনি সাইটেশন তৈরি করুন:

সাইটেশনের ধরন: {$citationTypes[$data['citation_type']]}
ফরম্যাট: {$formats[$format]}

প্রদত্ত তথ্য:
{$data['details']}

অনুগ্রহ করে নিম্নলিখিত প্রদান করুন:

১. **সম্পূর্ণ সাইটেশন**
   - প্রাথমিক সাইটেশন (Primary Citation)
   - সমান্তরাল সাইটেশন (Parallel Citation) যদি থাকে
   - সংক্ষিপ্ত সাইটেশন (Short Form)

২. **সাইটেশন উপাদান**
   - মামলার/আইনের নাম
   - রিপোর্টার/জার্নাল
   - খণ্ড ও পৃষ্ঠা নম্বর
   - বছর
   - আদালত (মামলার ক্ষেত্রে)

৩. **বাংলাদেশ আইন রিপোর্টস ফরম্যাট**
   - BLD (Bangladesh Legal Decisions)
   - DLR (Dhaka Law Reports)
   - BLT (Bangladesh Law Times)
   - BCR (Bangladesh Case Reports)
   - ADC (Appellate Division Cases)
   - HCD (High Court Division)

৪. **ব্যবহারের নির্দেশনা**
   - Footnote-এ কীভাবে ব্যবহার করবেন
   - Bibliography-তে কীভাবে লিখবেন
   - In-text citation

৫. **সাধারণ ভুল এড়ানো**
   - সঠিক ইটালিক ব্যবহার
   - সঠিক বিরামচিহ্ন
   - সঠিক সংক্ষেপ"
            : "You are a Bangladesh legal citation expert. Create proper legal citation based on the following information:

Citation Type: {$citationTypes[$data['citation_type']]}
Format: {$formats[$format]}

Provided Details:
{$data['details']}

Please provide:

1. **Complete Citation**
   - Primary Citation
   - Parallel Citation (if available)
   - Short Form Citation

2. **Citation Elements**
   - Case/Statute name
   - Reporter/Journal
   - Volume and page number
   - Year
   - Court (for cases)

3. **Bangladesh Law Reports Format**
   - BLD (Bangladesh Legal Decisions)
   - DLR (Dhaka Law Reports)
   - BLT (Bangladesh Law Times)
   - BCR (Bangladesh Case Reports)
   - ADC (Appellate Division Cases)
   - HCD (High Court Division)

4. **Usage Guidelines**
   - How to use in footnotes
   - How to write in bibliography
   - In-text citation

5. **Common Mistakes to Avoid**
   - Proper italicization
   - Correct punctuation
   - Correct abbreviations";

        return $this->makeAiRequest($prompt, $language);
    }

    /**
     * Common helper for AI requests
     */
    private function makeAiRequest(string $prompt, string $language): JsonResponse
    {
        try {
            $result = $this->gemini->askQuestion($prompt, $language);
            return new JsonResponse(['ok' => true, 'result' => $result['answer'] ?? $result]);
        } catch (GeminiException $e) {
            Log::error('Gemini API error: ' . $e->getMessage());
            $retryAfter = $e->getRetryAfter() ?? 30;
            return new JsonResponse([
                'ok' => false,
                'error' => $language === 'bn' 
                    ? 'AI সেবা অনুপলব্ধ। অনুগ্রহ করে পরে আবার চেষ্টা করুন।'
                    : 'AI service unavailable. Please try again later.',
                'retry_after' => $retryAfter
            ], 502);
        } catch (\Exception $e) {
            Log::error('Unexpected error in AI Features: ' . $e->getMessage());
            return new JsonResponse([
                'ok' => false, 
                'error' => $language === 'bn'
                    ? 'একটি অপ্রত্যাশিত ত্রুটি ঘটেছে।'
                    : 'An unexpected error occurred.'
            ], 500);
        }
    }

    /**
     * BD Law PDF Summarizer - Upload law PDFs and get AI summaries
     */
    public function summarizeLawPdf(Request $request): JsonResponse
    {
        $request->validate([
            'pdf_file' => 'required|file|mimes:pdf|max:10240', // Max 10MB
            'summary_type' => 'nullable|string|in:full,sections,key_points,comparison',
            'focus_area' => 'nullable|string|max:500',
            'language' => 'nullable|string|in:en,bn',
        ]);

        $language = $request->input('language', 'bn');
        $summaryType = $request->input('summary_type', 'full');
        $focusArea = $request->input('focus_area', '');

        try {
            $file = $request->file('pdf_file');
            if (!$file) {
                return new JsonResponse([
                    'ok' => false,
                    'error' => $language === 'bn' ? 'ফাইল আপলোড ব্যর্থ হয়েছে।' : 'File upload failed.'
                ], 400);
            }

            // Read PDF content
            $pdfContent = file_get_contents($file->getRealPath());
            if (!$pdfContent) {
                return new JsonResponse([
                    'ok' => false,
                    'error' => $language === 'bn' ? 'পিডিএফ পড়া যায়নি।' : 'Could not read PDF file.'
                ], 400);
            }

            // Convert to base64 for Gemini
            $base64Pdf = base64_encode($pdfContent);
            $fileName = $file->getClientOriginalName();

            // Build summary type instructions
            $summaryInstructions = $this->getSummaryInstructions($summaryType, $language);
            
            $focusNote = '';
            if (!empty($focusArea)) {
                $focusNote = $language === 'bn' 
                    ? "\n\nবিশেষ ফোকাস এলাকা: {$focusArea}"
                    : "\n\nSpecial focus area: {$focusArea}";
            }

            $prompt = $language === 'bn'
                ? "আপনি বাংলাদেশের আইন বিশেষজ্ঞ এবং আইনি দলিল বিশ্লেষক। নিম্নলিখিত পিডিএফ ফাইলটি একটি বাংলাদেশের আইন বা আইনি দলিল। এটি পড়ুন এবং বিশ্লেষণ করুন।

ফাইলের নাম: {$fileName}

{$summaryInstructions}{$focusNote}

অনুগ্রহ করে নিম্নলিখিত বিষয়গুলো অন্তর্ভুক্ত করুন:
১. আইনের শিরোনাম ও প্রকৃতি
২. প্রণয়নের তারিখ ও সংশোধনী (যদি থাকে)
৩. মূল উদ্দেশ্য ও লক্ষ্য
৪. গুরুত্বপূর্ণ ধারাসমূহ
৫. শাস্তির বিধান (যদি থাকে)
৬. প্রয়োগ ক্ষেত্র
৭. সাধারণ নাগরিকদের জন্য প্রভাব
৮. আইনজীবী ও বিচারকদের জন্য গুরুত্বপূর্ণ পয়েন্ট"
                : "You are a Bangladesh law expert and legal document analyst. The following PDF file is a Bangladesh law or legal document. Read and analyze it.

File name: {$fileName}

{$summaryInstructions}{$focusNote}

Please include:
1. Title and nature of the law
2. Date of enactment and amendments (if any)
3. Main objectives and goals
4. Key sections/provisions
5. Penalty provisions (if applicable)
6. Scope of application
7. Impact on general citizens
8. Important points for lawyers and judges";

            // Use Gemini with PDF content
            $result = $this->gemini->analyzeDocument($base64Pdf, $prompt, $language, 'application/pdf');
            
            return new JsonResponse(['ok' => true, 'result' => $result['answer'] ?? $result]);

        } catch (GeminiException $e) {
            Log::error('Gemini API error in PDF summarizer: ' . $e->getMessage());
            $retryAfter = $e->getRetryAfter() ?? 30;
            return new JsonResponse([
                'ok' => false,
                'error' => $language === 'bn' 
                    ? 'AI সেবা অনুপলব্ধ। অনুগ্রহ করে পরে আবার চেষ্টা করুন।'
                    : 'AI service unavailable. Please try again later.',
                'retry_after' => $retryAfter
            ], 502);
        } catch (\Exception $e) {
            Log::error('Error in PDF summarizer: ' . $e->getMessage());
            return new JsonResponse([
                'ok' => false, 
                'error' => $language === 'bn'
                    ? 'পিডিএফ বিশ্লেষণে সমস্যা হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।'
                    : 'Error analyzing PDF. Please try again.'
            ], 500);
        }
    }

    /**
     * Get summary instructions based on type
     */
    private function getSummaryInstructions(string $type, string $language): string
    {
        $instructions = [
            'full' => [
                'bn' => 'সম্পূর্ণ আইনটির বিস্তারিত সারসংক্ষেপ তৈরি করুন।',
                'en' => 'Create a comprehensive summary of the entire law.',
            ],
            'sections' => [
                'bn' => 'প্রতিটি অধ্যায় ও ধারার আলাদা সারসংক্ষেপ তৈরি করুন।',
                'en' => 'Create a section-by-section summary with each chapter and section explained.',
            ],
            'key_points' => [
                'bn' => 'শুধুমাত্র মূল পয়েন্ট ও গুরুত্বপূর্ণ বিষয়গুলো সংক্ষেপে উল্লেখ করুন।',
                'en' => 'Provide only the key points and important highlights in brief.',
            ],
            'comparison' => [
                'bn' => 'এই আইনটি পূর্ববর্তী আইন বা সংশ্লিষ্ট আইনের সাথে তুলনা করুন।',
                'en' => 'Compare this law with previous laws or related legislation.',
            ],
        ];

        return $instructions[$type][$language] ?? $instructions['full'][$language];
    }
}

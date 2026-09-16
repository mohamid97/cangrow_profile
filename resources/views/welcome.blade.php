<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome - {{ config('app.name', 'Laravel') }}</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Fallback if Vite is not running/built -->
            <style>
                /* Inlining app.css content for immediate preview if vite is not active */
                :root { --bg-color: #1e1e1e; --sidebar-bg: #252526; --activity-bar-bg: #333333; --status-bar-bg: #007acc; --status-bar-text: #ffffff; --tab-active-bg: #1e1e1e; --tab-inactive-bg: #2d2d2d; --tab-border: #252526; --text-color: #cccccc; --line-number: #858585; --selection-bg: #264f78; --scrollbar-bg: #424242; --scrollbar-thumb: #4f4f4f; --keyword: #569cd6; --control: #c586c0; --string: #ce9178; --function: #dcdcaa; --variable: #9cdcfe; --comment: #6a9955; --number: #b5cea8; --class: #4ec9b0; }
                * { box-sizing: border-box; margin: 0; padding: 0; }
                body { font-family: 'Fira Code', 'Consolas', 'Monaco', monospace; background-color: var(--bg-color); color: var(--text-color); height: 100vh; overflow: hidden; display: flex; flex-direction: column; font-size: 14px; }
                .main-container { display: flex; flex: 1; overflow: hidden; }
                .activity-bar { width: 48px; background-color: var(--activity-bar-bg); display: flex; flex-direction: column; align-items: center; padding-top: 10px; }
                .activity-icon { width: 48px; height: 48px; display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0.6; }
                .activity-icon.active { opacity: 1; border-left: 2px solid white; }
                .activity-icon svg { width: 24px; height: 24px; fill: #858585; }
                .activity-icon.active svg { fill: white; }
                .sidebar { width: 250px; background-color: var(--sidebar-bg); display: flex; flex-direction: column; border-right: 1px solid #000; }
                .sidebar-header { padding: 10px 20px; font-size: 11px; text-transform: uppercase; font-weight: bold; display: flex; justify-content: space-between; align-items: center; color: #bbbbbb; }
                .file-tree { padding: 0; list-style: none; margin-top: 5px; }
                .file-item { padding: 3px 20px; cursor: pointer; display: flex; align-items: center; gap: 6px; color: #cccccc; }
                .file-item:hover { background-color: #2a2d2e; }
                .file-item.active { background-color: #37373d; color: white; }
                .folder-header { padding: 5px 10px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 5px; color: #bbbbbb; }
                .editor-area { flex: 1; display: flex; flex-direction: column; background-color: var(--bg-color); }
                .tabs-bar { display: flex; background-color: var(--sidebar-bg); height: 35px; overflow-x: auto; }
                .tab { padding: 0 15px; display: flex; align-items: center; background-color: var(--tab-inactive-bg); border-right: 1px solid var(--tab-border); cursor: pointer; min-width: 120px; justify-content: space-between; font-size: 13px; color: #969696; }
                .tab.active { background-color: var(--tab-active-bg); color: white; border-top: 1px solid var(--status-bar-bg); }
                .tab-close { margin-left: 10px; font-size: 14px; opacity: 0; }
                .tab:hover .tab-close { opacity: 1; }
                .breadcrumbs { padding: 5px 15px; font-size: 13px; color: #858585; display: flex; gap: 5px; border-bottom: 1px solid #2d2d2d; }
                .code-container { flex: 1; padding: 10px 0; overflow-y: auto; font-family: 'Fira Code', 'Consolas', monospace; line-height: 1.5; }
                .code-line { display: flex; padding: 0 5px; }
                .code-line:hover { background-color: #2a2d2e; }
                .line-number { width: 50px; text-align: right; padding-right: 15px; color: var(--line-number); user-select: none; }
                .code-content { white-space: pre; }
                .kwd { color: var(--keyword); } .str { color: var(--string); } .com { color: var(--comment); } .fun { color: var(--function); } .num { color: var(--number); } .cls { color: var(--class); } .var { color: var(--variable); } .ctl { color: var(--control); }
                .status-bar { height: 22px; background-color: var(--status-bar-bg); color: var(--status-bar-text); display: flex; justify-content: space-between; align-items: center; padding: 0 10px; font-size: 12px; }
                .status-left, .status-right { display: flex; gap: 15px; }
                .status-item { display: flex; align-items: center; gap: 5px; cursor: pointer; }
                a { text-decoration: none; color: inherit; }
                a:hover { text-decoration: underline; }
            </style>
        @endif
    </head>
    <body>
        <div class="main-container">
            <!-- Activity Bar -->
            <div class="activity-bar">
                <div class="activity-icon active" title="Explorer">
                    <svg viewBox="0 0 24 24"><path d="M20 6h-8l-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 12H4V8h16v10z"/></svg>
                </div>
                <div class="activity-icon" title="Search">
                    <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                </div>
                <div class="activity-icon" title="Source Control">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41C17.92 5.77 20 8.65 20 12c0 2.08-.81 3.98-2.1 5.39z"/></svg>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-header">
                    <span>Explorer</span>
                    <span>...</span>
                </div>
                <div class="folder-header">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.99992 1.33334L1.33325 4.66668V11.3333L7.99992 14.6667L14.6666 11.3333V4.66668L7.99992 1.33334Z" stroke="#CCCCCC" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>PROJECT</span>
                </div>
                <ul class="file-tree">
                    <li class="file-item active">
                        <span style="color: #e37933; margin-right: 5px;">{}</span> welcome.blade.php
                    </li>
                    <li class="file-item">
                        <span style="color: #41b883; margin-right: 5px;">V</span> <a href="{{ route('login') }}">Login.vue</a>
                    </li>
                    <li class="file-item">
                        <span style="color: #41b883; margin-right: 5px;">V</span> <a href="{{ route('register') }}">Register.vue</a>
                    </li>
                    <li class="file-item">
                        <span style="color: #d4d4d4; margin-right: 5px;">#</span> .env
                    </li>
                    <li class="file-item">
                        <span style="color: #d4d4d4; margin-right: 5px;">{}</span> package.json
                    </li>
                </ul>
            </div>

            <!-- Editor Area -->
            <div class="editor-area">
                <div class="tabs-bar">
                    <div class="tab active">
                        <span style="color: #e37933; margin-right: 5px;">{}</span> welcome.blade.php
                        <span class="tab-close">x</span>
                    </div>
                    <div class="tab">
                        <span style="color: #41b883; margin-right: 5px;">V</span> Login.vue
                        <span class="tab-close">x</span>
                    </div>
                </div>
                
                <div class="breadcrumbs">
                    <span>resources</span> > <span>views</span> > <span>welcome.blade.php</span>
                </div>

                <div class="code-container">
                    <div class="code-line"><span class="line-number">1</span><span class="code-content"><span class="com">&lt;!-- Welcome to the Application --&gt;</span></span></div>
                    <div class="code-line"><span class="line-number">2</span><span class="code-content"><span class="kwd">class</span> <span class="cls">Application</span> <span class="kwd">extends</span> <span class="cls">Framework</span></span></div>
                    <div class="code-line"><span class="line-number">3</span><span class="code-content">{</span></div>
                    <div class="code-line"><span class="line-number">4</span><span class="code-content">    <span class="kwd">public</span> <span class="kwd">function</span> <span class="fun">index</span>()</span></div>
                    <div class="code-line"><span class="line-number">5</span><span class="code-content">    {</span></div>
                    <div class="code-line"><span class="line-number">6</span><span class="code-content">        <span class="kwd">return</span> <span class="cls">View</span>::<span class="fun">make</span>(<span class="str">'welcome'</span>, [</span></div>
                    <div class="code-line"><span class="line-number">7</span><span class="code-content">            <span class="str">'version'</span> => <span class="str">'{{ Illuminate\Foundation\Application::VERSION }}'</span>,</span></div>
                    <div class="code-line"><span class="line-number">8</span><span class="code-content">            <span class="str">'php'</span>     => <span class="str">'{{ PHP_VERSION }}'</span>,</span></div>
                    <div class="code-line"><span class="line-number">9</span><span class="code-content">            <span class="str">'status'</span>  => <span class="str">'Running'</span></span></div>
                    <div class="code-line"><span class="line-number">10</span><span class="code-content">        ]);</span></div>
                    <div class="code-line"><span class="line-number">11</span><span class="code-content">    }</span></div>
                    <div class="code-line"><span class="line-number">12</span><span class="code-content"></span></div>
                    <div class="code-line"><span class="line-number">13</span><span class="code-content">    <span class="com">/**</span></span></div>
                    <div class="code-line"><span class="line-number">14</span><span class="code-content"><span class="com">     * Useful Links for Development</span></span></div>
                    <div class="code-line"><span class="line-number">15</span><span class="code-content"><span class="com">     */</span></span></div>
                    <div class="code-line"><span class="line-number">16</span><span class="code-content">    <span class="kwd">public</span> <span class="kwd">function</span> <span class="fun">resources</span>()</span></div>
                    <div class="code-line"><span class="line-number">17</span><span class="code-content">    {</span></div>
                    <div class="code-line"><span class="line-number">18</span><span class="code-content">        <span class="kwd">return</span> [</span></div>
                    <div class="code-line"><span class="line-number">19</span><span class="code-content">            <span class="str">'docs'</span>  => <span class="str">'<a href="https://laravel.com/docs" target="_blank" class="str">https://laravel.com/docs</a>'</span>,</span></div>
                    <div class="code-line"><span class="line-number">20</span><span class="code-content">            <span class="str">'news'</span>  => <span class="str">'<a href="https://laravel-news.com" target="_blank" class="str">https://laravel-news.com</a>'</span>,</span></div>
                    <div class="code-line"><span class="line-number">21</span><span class="code-content">            <span class="str">'casts'</span> => <span class="str">'<a href="https://laracasts.com" target="_blank" class="str">https://laracasts.com</a>'</span></span></div>
                    <div class="code-line"><span class="line-number">22</span><span class="code-content">        ];</span></div>
                    <div class="code-line"><span class="line-number">23</span><span class="code-content">    }</span></div>
                    <div class="code-line"><span class="line-number">24</span><span class="code-content"></span></div>
                    <div class="code-line"><span class="line-number">25</span><span class="code-content">    <span class="com">/*</span></span></div>
                    <div class="code-line"><span class="line-number">26</span><span class="code-content"><span class="com">     * Authentication Status</span></span></div>
                    <div class="code-line"><span class="line-number">27</span><span class="code-content"><span class="com">     */</span></span></div>
                    <div class="code-line"><span class="line-number">28</span><span class="code-content">    @if (Route::has('login'))</span></div>
                    <div class="code-line"><span class="line-number">29</span><span class="code-content">    <span class="kwd">public</span> <span class="kwd">function</span> <span class="fun">auth</span>()</span></div>
                    <div class="code-line"><span class="line-number">30</span><span class="code-content">    {</span></div>
                    <div class="code-line"><span class="line-number">31</span><span class="code-content">        @auth</span></div>
                    <div class="code-line"><span class="line-number">32</span><span class="code-content">        <span class="kwd">return</span> <span class="cls">User</span>::<span class="fun">find</span>(<span class="num">{{ auth()->user()->id }}</span>); <span class="com">// <a href="{{ url('/home') }}" class="kwd">Go to Home</a></span></span></div>
                    <div class="code-line"><span class="line-number">33</span><span class="code-content">        @else</span></div>
                    <div class="code-line"><span class="line-number">34</span><span class="code-content">        <span class="kwd">return</span> <span class="str">'Guest'</span>; <span class="com">// <a href="{{ route('login') }}" class="kwd">Log in</a> or <a href="{{ route('register') }}" class="kwd">Register</a></span></span></div>
                    <div class="code-line"><span class="line-number">35</span><span class="code-content">        @endauth</span></div>
                    <div class="code-line"><span class="line-number">36</span><span class="code-content">    }</span></div>
                    <div class="code-line"><span class="line-number">37</span><span class="code-content">    @endif</span></div>
                    <div class="code-line"><span class="line-number">38</span><span class="code-content">}</span></div>
                </div>
            </div>
        </div>

        <!-- Status Bar -->
        <div class="status-bar">
            <div class="status-left">
                <div class="status-item">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="white"><path d="M4 8l2-2 5 5-5 5-2-2 3-3-3-3z"/></svg>
                    main*
                </div>
                <div class="status-item">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="white"><path d="M8 1a7 7 0 100 14A7 7 0 008 1zm0 12a5 5 0 110-10 5 5 0 010 10z"/></svg>
                    0 errors, 0 warnings
                </div>
            </div>
            <div class="status-right">
                <div class="status-item">Ln 1, Col 1</div>
                <div class="status-item">UTF-8</div>
                <div class="status-item">PHP</div>
                <div class="status-item">Prettier</div>
            </div>
        </div>
    </body>
</html>

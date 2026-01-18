<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gesigan Jeevee May - CV</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Calibri', 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            line-height: 1.5;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 40px 50px 30px;
            border-bottom: 3px solid #00a8e8;
        }

        .header-left h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-subtitle {
            color: #00a8e8;
            font-size: 11px;
            margin-bottom: 12px;
            line-height: 1.6;
        }

        .header-contact {
            font-size: 10px;
            color: #333;
        }

        .header-contact span {
            margin-right: 15px;
        }

        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            border: 3px solid white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        /* Main Content */
        .main-content {
            display: flex;
        }

        /* Left Column */
        .left-column {
            width: 60%;
            padding: 30px 50px;
        }

        /* Right Column */
        .right-column {
            width: 40%;
            background: #f8f9fa;
            padding: 30px 35px;
        }

        /* Section Styles */
        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #333;
            letter-spacing: 0.5px;
        }

        .section-content {
            font-size: 11px;
            color: #333;
            line-height: 1.7;
        }

        /* Experience Items */
        .experience-item {
            margin-bottom: 20px;
        }

        .experience-header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .experience-icon {
            width: 18px;
            height: 18px;
            background: #00a8e8;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .experience-title {
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 2px;
        }

        .experience-company {
            font-size: 11px;
            color: #666;
            margin-bottom: 3px;
        }

        .experience-date {
            font-size: 10px;
            color: #00a8e8;
            margin-bottom: 8px;
        }

        .experience-location {
            font-size: 10px;
            color: #999;
            margin-bottom: 8px;
        }

        .experience-description {
            font-size: 11px;
            color: #444;
            line-height: 1.6;
        }

        .experience-description ul {
            margin-left: 0;
            padding-left: 15px;
        }

        .experience-description li {
            margin-bottom: 5px;
        }

        /* Achievement Items */
        .achievement-item {
            margin-bottom: 18px;
            padding-left: 25px;
            position: relative;
        }

        .achievement-item:before {
            content: "★";
            position: absolute;
            left: 0;
            color: #00a8e8;
            font-size: 14px;
        }

        .achievement-title {
            font-weight: 700;
            font-size: 11px;
            margin-bottom: 4px;
        }

        .achievement-description {
            font-size: 10px;
            color: #555;
            line-height: 1.6;
        }

        /* Skills */
        .skills-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .skill-item {
            background: white;
            padding: 8px 12px;
            border-left: 3px solid #00a8e8;
            font-size: 11px;
            font-weight: 600;
        }

        /* Passions */
        .passion-item {
            margin-bottom: 18px;
        }

        .passion-icon {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
        }

        .passion-icon:before {
            content: "♥";
            color: #00a8e8;
            font-size: 16px;
        }

        .passion-title {
            font-weight: 700;
            font-size: 11px;
        }

        .passion-description {
            font-size: 10px;
            color: #555;
            line-height: 1.6;
        }

        /* Education */
        .education-item {
            margin-bottom: 15px;
        }

        .education-degree {
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 3px;
        }

        .education-school {
            font-size: 11px;
            color: #666;
            margin-bottom: 2px;
        }

        .education-year {
            font-size: 10px;
            color: #00a8e8;
        }

        /* Footer */
        .footer {
            padding: 15px 50px;
            background: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            font-size: 9px;
            color: #999;
        }

        @media print {
            body {
                padding: 0;
            }

            .container {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1>GESIGAN JEEVEE MAY</h1>
                <div class="header-subtitle">
                    National Account Executive | Sales Growth | Strategic Planning
                </div>
                <div class="header-contact">
                    <span>📞 +44 207 9324 4567</span>
                    <span>✉ hello@reallygreatsite.com</span>
                    <span>📍 Wellington, UK</span>
                </div>
            </div>
            <div class="profile-photo">GJ</div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Left Column -->
            <div class="left-column">
                <!-- Summary -->
                <div class="section">
                    <div class="section-title">SUMMARY</div>
                    <div class="section-content">
                        With over 9 years of experience in sales and national account management, I've consistently
                        delivered strong performance and client satisfaction. I'm an excellent communicator, effective
                        negotiator, and skilled at balancing multiple priorities while integrating fast-paced
                        operational sales processes and successful product launches. I thrive in fast-moving
                        environments and take ownership.
                    </div>
                </div>

                <!-- Experience -->
                <div class="section">
                    <div class="section-title">EXPERIENCE</div>

                    <div class="experience-item">
                        <div class="experience-header">
                            <div class="experience-icon"></div>
                            <div>
                                <div class="experience-title">National Sales Manager</div>
                                <div class="experience-company">BerGenBio | Ferrells Ltd.</div>
                                <div class="experience-date">06/2018 - 04/2019</div>
                                <div class="experience-location">📍 Wellington, UK</div>
                            </div>
                        </div>
                        <div class="experience-description">
                            <ul>
                                <li>Developed and executed a national sales plan by forming strong relationships with
                                    key customers.</li>
                                <li>Negotiated advantageous terms on promotional activities, maximizing product
                                    visibility and sales growth by 40%.</li>
                                <li>Led a team of 8 account executives, consistently growing sales, reducing excess
                                    stock by 45% to maximizing revenue recovery.</li>
                                <li>Facilitated meetings to identify sales trends, making strategic recommendations that
                                    improved national sales.</li>
                                <li>Established consistent processes, getting pricing schemes vetted across all new
                                    products.</li>
                                <li>Facilitated a collaborative initiative with key supply chain to optimize product
                                    cycle, reducing excess stock by 55% while maximizing supply chain operations.</li>
                                <li>Presented monthly figures to the Sales Director and the CEO, supported by KPIs
                                    metrics share which to first quarter profit results.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="experience-item">
                        <div class="experience-header">
                            <div class="experience-icon"></div>
                            <div>
                                <div class="experience-title">Sales Executive</div>
                                <div class="experience-company">Hanover Ltd.</div>
                                <div class="experience-date">04/2014 - 02/2018</div>
                                <div class="experience-location">📍 Manchester, UK</div>
                            </div>
                        </div>
                        <div class="experience-description">
                            <ul>
                                <li>Consistently exceeded goals. Spearheaded innovative market analysis and exploration.
                                </li>
                                <li>Developed and maintained productive relationships with a portfolio of 20 clients,
                                    building annual revenues by 40%.</li>
                                <li>Achieved 90% collection rates by using consistent proven follow-up processes.</li>
                                <li>Managed support efforts, executing financial processes and consequently improving
                                    payment collections by 50%.</li>
                                <li>Worked extensively with the VP of Sales and Account Management to create winning
                                    sales strategy.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="experience-item">
                        <div class="experience-header">
                            <div class="experience-icon"></div>
                            <div>
                                <div class="experience-title">Account Coordinator</div>
                                <div class="experience-company">Price Freeman & Co.</div>
                                <div class="experience-date">01/2012 - 02/2014</div>
                                <div class="experience-location">📍 Manchester, UK</div>
                            </div>
                        </div>
                        <div class="experience-description">
                            <ul>
                                <li>Played a pivotal role in increasing brand presence in 30 new locations, becoming
                                    regions sales by 30%.</li>
                                <li>Oversaw product processing, including invoices, manifests, new product launches, and
                                    seasonal sales campaigns.</li>
                                <li>Managed promotional events and campaigns, leading to a 25% increase in emotional
                                    connection to the brand and products.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Education -->
                <div class="section">
                    <div class="section-title">EDUCATION</div>
                    <div class="education-item">
                        <div class="education-degree">Bachelor of Science in Business Administration</div>
                        <div class="education-school">University of Studio</div>
                        <div class="education-year">09/2008 - 06/2012 | Wellington, UK</div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column">
                <!-- Achievements -->
                <div class="section">
                    <div class="section-title">ACHIEVEMENTS</div>

                    <div class="achievement-item">
                        <div class="achievement-title">Top Performer Award</div>
                        <div class="achievement-description">Recognized 3 consecutive years in 2021 at BerGenBio
                            Ferrells Ltd. for exceeding sales targets by 25% annually and excellent account management.
                        </div>
                    </div>

                    <div class="achievement-item">
                        <div class="achievement-title">Successful Product Launch</div>
                        <div class="achievement-description">Led a team that introduced a new product line that
                            generated £1M in revenue within the first quarter in Hanover Ltd.</div>
                    </div>

                    <div class="achievement-item">
                        <div class="achievement-title">Best Marketing Campaign Collaboration</div>
                        <div class="achievement-description">Collaborated with our Marketing department to launch a
                            successful brand campaign, resulting in a 30% increase in sales at BerGenBio Ferrells Ltd.
                        </div>
                    </div>

                    <div class="achievement-item">
                        <div class="achievement-title">Mentorship Excellence</div>
                        <div class="achievement-description">Developed a mentorship program that has successfully
                            trained over 15 junior sales executives.</div>
                    </div>
                </div>

                <!-- Skills -->
                <div class="section">
                    <div class="section-title">SKILLS</div>
                    <div class="skills-grid">
                        <div class="skill-item">Sales Growth Strategies</div>
                        <div class="skill-item">Financial Acumen</div>
                        <div class="skill-item">Strategic Planning</div>
                        <div class="skill-item">Product Management</div>
                        <div class="skill-item">Client Relationship Management</div>
                        <div class="skill-item">Team Leadership</div>
                        <div class="skill-item">Advanced Negotiation Skills</div>
                        <div class="skill-item">Commercial Awareness</div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-content" style="font-size: 10px; line-height: 1.7;">
                        <strong>Effective Buyer-Client Relationship:</strong> Adept at forging lasting and meaningful
                        business relationships by leveraging my ability to ensure client happiness, quick
                        problem-solving, and consistent follow-up.
                        <br><br>
                        <strong>Strategic Vision:</strong> Able to identify growth opportunities through market
                        analysis, drawing sound from the Institute of Sales Management, Royal Economics Society, and
                        Institute of Directors along with 9 years of experience.
                    </div>
                </div>

                <!-- Passions -->
                <div class="section">
                    <div class="section-title">PASSIONS</div>

                    <div class="passion-item">
                        <div class="passion-icon">
                            <div class="passion-title">Sales & Market Growth</div>
                        </div>
                        <div class="passion-description">Passionate about identifying new market opportunities and
                            driving sales performance.</div>
                    </div>

                    <div class="passion-item">
                        <div class="passion-icon">
                            <div class="passion-title">Health & Wellness</div>
                        </div>
                        <div class="passion-description">Committed to maintaining health and wellness. A strong advocate
                            for work-life balance, advocating for wellness initiatives in the organizations I'm a part
                            of.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>WWW.REALLYGREATSITE.COM</div>
            <div>POWERED BY ❤ ENHANCV</div>
        </div>
    </div>
</body>

</html>
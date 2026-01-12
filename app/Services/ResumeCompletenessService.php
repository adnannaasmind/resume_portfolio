<?php

namespace App\Services;

class ResumeCompletenessService
{
    /**
     * Calculate a completeness score (0-100) based on filled sections.
     */
    public function calculate(?array $data): int
    {
        if (!$data) {
            return 0;
        }

        $sections = [
            'basics' => 20,
            'summary' => 10,
            'experience' => 25,
            'education' => 15,
            'skills' => 10,
            'projects' => 10,
            'certifications' => 5,
            'languages' => 5,
        ];

        $score = 0;

        foreach ($sections as $section => $weight) {
            if (!array_key_exists($section, $data)) {
                continue;
            }

            $value = $data[$section];
            $filled = false;

            if (is_string($value)) {
                $filled = trim($value) !== '';
            } elseif (is_array($value)) {
                $filled = count(array_filter($value)) > 0;
            }

            if ($filled) {
                $score += $weight;
            }
        }

        return (int) min(100, max(0, $score));
    }
}

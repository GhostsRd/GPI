<?php
$file = 'C:/Users/Hasina/Desktop/hasina/GPI/resources/views/livewire/equipement/moniteur.blade.php';
$content = file_get_contents($file);

$directives = ['if', 'else', 'elseif', 'endif', 'foreach', 'endforeach', 'forelse', 'empty', 'endforelse', 'while', 'endwhile', 'for', 'endfor', 'section', 'endsection', 'auth', 'endauth', 'guest', 'endguest', 'error', 'enderror', 'push', 'endpush', 'stack'];

$counts = [];
foreach ($directives as $d) {
    // Match @directive but not @@directive
    // Using a more robust regex to find directives
    preg_match_all('/(?<!@)@' . $d . '\b/', $content, $matches);
    $counts[$d] = count($matches[0]);
}

echo "Blade Directive Counts for moniteur.blade.php:\n";
printf("%-15s | %-15s | %s\n", "Directive", "Start/Other", "End");
echo str_repeat("-", 45) . "\n";

printf("%-15s | %-15s | %s\n", "if/else/endif", ($counts['if'] + $counts['else'] + $counts['elseif']), $counts['endif']);
printf("%-15s | %-15s | %s\n", "foreach", $counts['foreach'], $counts['endforeach']);
printf("%-15s | %-15s | %s\n", "forelse", ($counts['forelse'] + $counts['empty']), $counts['endforelse']);
printf("%-15s | %-15s | %s\n", "section", $counts['section'], $counts['endsection']);
printf("%-15s | %-15s | %s\n", "auth", $counts['auth'], $counts['endauth']);
printf("%-15s | %-15s | %s\n", "guest", $counts['guest'], $counts['endguest']);
printf("%-15s | %-15s | %s\n", "error", $counts['error'], $counts['enderror']);
printf("%-15s | %-15s | %s\n", "push", $counts['push'], $counts['endpush']);

echo "\nDetailed Counts:\n";
print_r($counts);

// Find potential range of unclosed IF
if ($counts['if'] > $counts['endif']) {
    echo "\nWarning: Found " . $counts['if'] . " @if and " . $counts['endif'] . " @endif\n";
}

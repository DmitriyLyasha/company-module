<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id', 'project_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function updateProjects(array $data): void
    {
        if (isset($data['project_id'])) {
            $projectIds = is_array($data['project_id']) ? $data['project_id'] : [$data['project_id']];
            $method = $this->projects()->exists() ? 'sync' : 'attach';
            $this->projects()->$method($projectIds);
        }
    }

    public function updateWithProject(array $data): bool
    {
        $this->update($data);
        $this->updateProjects($data);

        return true;
    }
}
